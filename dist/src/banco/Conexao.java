/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package banco;

import java.sql.Connection;
import java.sql.DriverManager;

/**
 *
 * @author juci_reis-junior
 */
public class Conexao {

    public static Connection conexao;
    
    public Conexao() throws Exception{
        String url = "";
        String usuario = "";
        String senha = "";
        
        Class.forName("com.mysql.jdbc.Driver");
        url = "jdbc:mysql://localhost:3306/loja?useSSL=false";
        usuario = "root";
        senha = "root";
        
        conexao = (Connection) DriverManager.getConnection(url, usuario, senha);
    }
    
    public Connection getConexao(){
        return conexao;
    }
    
}
