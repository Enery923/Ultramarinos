package ultramarinos;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;

/**
 *
 * @author Paula
 */



public class Conexion{
    
    private String usuario = "DB_ULTRAMARINOS";
    private String contraseña = "paula";
    private String url = "jdbc:oracle:thin:@localhost:1521:XE";
    private Connection conexion;
    
    
    public Conexion(){
        try{
         //obtenemos el driver de para mysql
         Class.forName("oracle.jdbc.OracleDriver");
         //obtenemos la conexión
         conexion = DriverManager.getConnection(url,usuario,contraseña);
         if (conexion!=null){
            System.out.println("Conexión correcta");
         }
      }catch(  SQLException | ClassNotFoundException e){
         System.out.println(e);
      }
    }

   /**
    * 
    * @return
    */
   public Connection getConnection()
    {
        return this.conexion;
    }
    
    
   
   /* Método para realizar una consulta a la base de datos */
   
   public Object [][] select(String table, String fields, String where){
       int registros = 0;      
      String colname[] = fields.split(",");

      String q ="SELECT " + fields + " FROM " + table;
      String q2 = "SELECT count(*) as total FROM " + table;
      if(where!=null)
      {
          q+= " WHERE " + where;
          q2+= " WHERE " + where;
      }
       try{
         PreparedStatement pstm = conexion.prepareStatement(q2);
         ResultSet res = pstm.executeQuery();
         res.next();
         registros = res.getInt("total");
         res.close();
      }catch(SQLException e){
         System.out.println(e);
      }
 
    Object[][] data = new String[registros][fields.split(",").length];
  
      try{
         PreparedStatement pstm = conexion.prepareStatement(q);
         ResultSet res = pstm.executeQuery();
         int i = 0;
         while(res.next()){
            for(int j=0; j<=fields.split(",").length-1;j++){
                data[i][j] = res.getString( colname[j].trim() );
            }
            i++;         }
         res.close();
          }catch(SQLException e){
         System.out.println(e);
    }
    return data;
 }
       
   /* Método para insertar un registro en la base de datos */
   public boolean insert(String table, String fields, String values)
    {
        boolean res=false;
       
        String q=" INSERT INTO " + table + " ( " + fields + " ) VALUES ( " + values + " ) ";
        
        try {
            PreparedStatement pstm = conexion.prepareStatement(q);
            pstm.execute();
            pstm.close();
            res=true;
         }catch(SQLException e){
         System.out.println(e);
      }
      return res;
    }
   
   /* Método para actualizar datos de una tabla */
   
    public void Update (String tabla,String valor,String columna,String condicion){
         String u=" UPADTE " + tabla + 
                 " SET " + columna + "=" + valor + 
                 " where "+ condicion;
        
        try {
            PreparedStatement pstm = conexion.prepareStatement(u);
            pstm.execute();
            pstm.close();
         }catch(SQLException e){
         System.out.println(e);
      }
    }

    
    /* Método para eliminar un registro de la base de datos */
    
    public void eliminar(String tabla,String condicion){
       String d=" DELETE FROM "+tabla+ 
                 " where "+ condicion;
       
        try {
            PreparedStatement pstm = conexion.prepareStatement(d);
            pstm.executeUpdate();
            pstm.close();
         }catch(SQLException e){
         System.out.println(e);
      }
    }
    
    /* Método para desconectar de la base de datos */
    public void desconectar(){
      conexion = null;
      System.out.println("La conexion a la  base de datos a terminado.");
   }

}