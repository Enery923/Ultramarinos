package ultramarinos;


import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.io.File;
import java.net.URL;
import javax.help.HelpBroker;
import javax.help.HelpSet;
import javax.swing.JOptionPane;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Paula
 */
public class Controlador implements ActionListener{
    private VentanaPrincipal view;
    private Modelo model;
    
    Login frmLogin = new Login (view, true);
    AdministrarProducto frmConsultarProducto = new AdministrarProducto(view,true);
    AdministrarUsuarios frmAdministrarUsuario= new AdministrarUsuarios(view, true);
    
   
    

    public Controlador(VentanaPrincipal vista, Modelo modelo) {
        this.view = vista;
       this.model = modelo;
      
       iniciar();
    }
 public void go()
    {
        this.view.setVisible(true);
    }
   
    public void iniciar(){
        
        /*Añadimos acciones a los botones*/
        this.view.botonLogueo.setActionCommand("Iniciar sesion");
        this.view.botonBackup.setActionCommand("Copia de seguridad");
        this.view.botonSalir.setActionCommand("Cerrar sesion");
        this.view.botonAyuda.setActionCommand("Ayuda");
        this.view.botonConsultar.setActionCommand("Administrar productos");
        this.view.botonAdministrar.setActionCommand("Administrar usuarios");
        this.frmLogin.botonAceptar.setActionCommand("Ingresar");
        
        
        /*Escuchamos las acciones*/
        view.botonLogueo.addActionListener(this);
        view.botonSalir.addActionListener(this);
        view.botonConsultar.addActionListener(this);
        view.botonAyuda.addActionListener(this);
        view.botonBackup.addActionListener(this);
        frmLogin.botonAceptar.addActionListener(this);
        
       
        
        /*Damos funcionalidad a los botones*/
        this.view.botonLogueo.setEnabled(true);
        this.view.botonAyuda.setEnabled(true);
        this.view.botonSalir.setEnabled(false);
        this.view.botonBackup.setEnabled(false);
        this.view.botonConsultar.setEnabled(false);
        this.view.botonAdministrar.setEnabled(false);
        
    }
 
 
    @Override
    public void actionPerformed(ActionEvent e) {
        String comando = e.getActionCommand();
       
     
        if( comando.equals("Iniciar sesion"))
        {
            frmLogin.setVisible(true);
           
            
        }else if( comando.equals("Cerrar sesion"))
        {
            this.view.botonLogueo.setEnabled(true);
            this.view.botonSalir.setEnabled(false);
            this.view.botonBackup.setEnabled(false);
            this.view.botonConsultar.setEnabled(false);
        }
        
        if( comando.equals("Administrar usuarios")){
             frmAdministrarUsuario.setVisible(true);
        }
        
        if( comando.equals("Ingresar")){
            if( this.model.ingresarUsuario(this.frmLogin.textUser.getText(),this.frmLogin.textPassword.getText()) ){
                frmLogin.dispose();
                this.view.botonLogueo.setEnabled(false);
                this.view.botonSalir.setEnabled(true);
                this.view.botonConsultar.setEnabled(true);
                this.view.botonBackup.setEnabled(false);
               
            }else{
                if(this.model.ingresarAdministrador(frmLogin.textPassword.getText(), frmLogin.textUser.getText())){
                    this.view.botonLogueo.setEnabled(false);
                    this.view.botonSalir.setEnabled(true);
                    this.view.botonBackup.setEnabled(true);
                    this.view.botonConsultar.setEnabled(true);
                    this.view.botonAdministrar.setEnabled(true);
                    frmLogin.dispose();
                }else{
                    JOptionPane.showMessageDialog(this.view,"Error: Las credenciales son incorrectas");
                }
            }
        }
        
    }
    
}
