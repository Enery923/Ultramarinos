package ultramarinos;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Paula
 */
public class Main {
    public static void main(String[] args) {
        // TODO code application logic here
         Modelo modelo = new Modelo();
        VentanaPrincipal vista = new VentanaPrincipal();
         new Controlador(vista, modelo).go();
    }
}
