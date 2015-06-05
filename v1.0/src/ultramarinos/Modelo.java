package ultramarinos;


import java.sql.PreparedStatement;
import java.sql.SQLException;
import javax.swing.JOptionPane;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Paula
 */
public class Modelo extends Conexion{
    
    public Usuario user = new Usuario();
    public Administrador admin = new Administrador();

    public Modelo() {
    }
    
    public boolean ingresarUsuario(String usuario, String contraseña){
        
        Object[][] res = this.select("usuarios", "nombre, usuario, contraseña", " usuario='"+usuario+"' AND contraseña='"+contraseña+"' "); 
        if( res.length > 0)
        {
            user.setUsuario( res[0][0].toString() );
            user.setContraseña( res[0][1].toString() );
            user.setNombre( res[0][2].toString() );
            
            return true;
        }        
        else{
        return false;
        }
        
        
    }
    public boolean ingresarAdministrador(String contraseña, String usuario)
    {        
        Object[][] res = this.select("administradores", "usuario, contraseña, nombre", " usuario='"+usuario+"' AND contraseña='"+contraseña+"' ");
        if( res.length > 0)
        {
            admin.setUsuario( res[0][0].toString() );
            admin.setContraseña( res[0][1].toString() );
            admin.setNombre( res[0][2].toString() );
            
            return true;
        }        
        else{
            return false;
        }
    }
    
    public Object[][] getProductos(){
        Object[][] res = this.select("productos", "id_producto, nombre, marca, precio, disponibilidad", null);
        
        if( res.length > 0){
            return res;
        }else{
            return null;
        }
        
    }
    
    public Object[][] getUsuarios(){
        Object[][] res = this.select("usuarios", "nombre, usuario, contraseña", null);
        if( res.length > 0){
            return res;
        }else{
            return null;
        }
    }
    
    /* Métodos para registrar un usuario y un producto respectivamente */
    public void insertarUsuario(String nombre, String usuario, String contraseña){
        this.insert("usuarios","nombre, usuario, contraseña"," '"+nombre+"', '"+usuario+"', '"+contraseña+"'");
        JOptionPane.showMessageDialog(null, "Usuario creado correctamente");
    }
    
    public void insertarProducto(String id_producto, String nombre, String marca, String precio, String disponibilidad){
        this.insert("productos", "id_producto, nombre, marca, precio, disponibilidad", " '"+id_producto+"', '"+nombre+"', '"+marca+"', '"+precio+"', '"+disponibilidad+"' ");
        JOptionPane.showMessageDialog(null, "Producto añadido correctamente");
    }
    
    /* Métodos para modificar un usuario y un producto respectivamente */
    public void modificarUsuario(String nombre, String usuario, String contraseña){
        try
        {
            PreparedStatement pstm = this.getConnection().prepareStatement("UPDATE usuarios SET nombre='"+nombre+"', usuario='"+usuario
                    +"', contraseña='"+contraseña
                    +"' WHERE nombre='"+nombre+"'");
            
            pstm.execute();
            pstm.close();
            JOptionPane.showMessageDialog(null, "El usuario " + usuario +" se ha modificado correctamente"); 
        }
        
        catch(SQLException e)
        {
            JOptionPane.showMessageDialog(null, e);
        }   
    }
    
    public void modificarProducto(String id_producto, String nombre, String marca, String precio, String disponibilidad){
        try
        {
            PreparedStatement pstm = this.getConnection().prepareStatement("UPDATE productos SET id_producto='"+id_producto+"', nombre='"+nombre+"', marca='"+marca+"', precio='"+precio+"', disponibilidad='"+disponibilidad+"' WHERE id_producto='"+id_producto+"' ");
            pstm.execute();
            pstm.close();
            JOptionPane.showMessageDialog(null, "El producto " + nombre +" se ha modificado correctamente"); 
        }
        
        catch(SQLException e)
        {
            JOptionPane.showMessageDialog(null, e);
        }   
    }
    
    /* Métodos para eliminar un usuario y un producto respectivamente */
    public void eliminarUsuario(String condicion){
        this.eliminar("usuarios", "nombre='"+condicion+"' ");
        JOptionPane.showMessageDialog(null, "Se ha eliminado correctamente");
    }
    
    public void eliminarProducto(String condicion){
        this.eliminar("productos", "id_producto='"+condicion+"' ");
        JOptionPane.showMessageDialog(null, "Se ha eliminado correctamente");
    }
}
