package fr.driss_soudani.ds_restiloc;

import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.os.Looper;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;


import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;

import com.vishnusivadas.advanced_httpurlconnection.PutData;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.Arrays;


public class Login extends AppCompatActivity {

    private EditText etLogin, etPassword;
    private Button btnSeConnecter;

    //Adresse complète du fichier php situé sur le serveur qui va executé le script de Login
    //Sur Wampserver :
    // - Ajouter l'écoute du port 8000 : Clic doit -> outils -> ajouter un Listen port à Apache
    // - Ajouter un 2ème VirtualHost pour le site en utilisant le port 8000 (clic gauche -> Vos VirtualHosts -> Gestion VirtualHost
    //Exemple du contenu de virtual host:
    //1er virtual host, pour un accès à partir de l'ordinateur : ServerName : restiloc-ac - Directory : z:/sio2/projets/restiloc/siterestiloc_ac
    //2ème virtual host, pour un accès à partir du smartphone (virtuel ou physique) : ServerName : restiloc-ac:8000 - Directory : z:/sio2/projets/restiloc/siterestiloc_ac
    private static String URL = "http://your_ip/loginExpert.php";

    @Override
    protected void onCreate(@Nullable Bundle savedInstanceState) {
        //Appeler le constructeur de la classe mère
        super.onCreate(savedInstanceState);
        //Associer la classe à son interface visuelle définie dans le fichier 'activity_login.xml' dossier 'res' du projet
        setContentView(R.layout.activity_login);

        //Associer les propriétés de la classe aux éléments visuels de l'interface
        etLogin = findViewById(R.id.etLogin);
        etPassword = findViewById(R.id.etPassword);

        btnSeConnecter = findViewById(R.id.btnSeConnecter);

        //Définir l'évenement onClickListner sur le bouton
        btnSeConnecter.setOnClickListener(new View.OnClickListener() {
            //Surcharger la fonction onClick
            @Override
            public void onClick(View view) {
                String login, password;
                //Récupérer les contenus des EditText de l'interface visuelle
                login = etLogin.getText().toString().trim();
                password = etPassword.getText().toString().trim();
                //Si les champs login et password sont tous les 2 renseignés
                if(!login.equals("") && !password.equals("") ){
                    //Implémenter l'interface Runnable qui va spécifier et encapsuler le code destiné à être exécuté dans un thread
                    Handler handler = new Handler(Looper.getMainLooper());
                    handler.post(new Runnable() {
                        //Définition de la méthode run() qui contient Le code à exécuter
                        @Override
                        public void run() {
                            //Créer les clés des paramètres qui seront envoyés au serveur
                            String[] keys = new String[2];
                            keys[0] = "username";
                            keys[1] = "password";

                            //Créer les valeurs des paramètres créés précedement
                            String[] values = new String[2];
                            values[0] = login;
                            values[1] = password;
                            //Creer l'objet qui va communiquer avec le serveur en lui indiquant l'URL du fichier php à appeler et les données à envoyer ainsi que la methode à utiliser
                            PutData putData = new PutData(URL, "POST", keys, values);
                            //Exécuter le script de communication : startPut() renvoi true si la communication a pu commencer
                            if (putData.startPut()) {
                                //Traiter la réponse du serveur
                                if (putData.onComplete()) {
                                    //Récupérer le résultat renvoyer par le serveur (correspond à la chaine affichée par l'écho réalisé dans la page php appelée
                                    String result = putData.getResult();
                                    //Splitter la chaine reçue en utilisant le séparateur défini dans le fichier php (ici : %)
                                    String[] msg = result.split("%");
                                    System.out.println(Arrays.toString(msg));
                                    String message = null;
                                    try {
                                        JSONObject jsonResult = new JSONObject(result);
                                        message = jsonResult.getString("message");
                                        System.out.println(message);
                                    } catch (JSONException e) {
                                        System.err.println("Error parsing JSON response: " + e.getMessage());
                                    }
                                    //Si la 1ère partie de la chaine splittée contient "SUCCESS" c'est que l'action a réussie (voir le fichier php)

                                    if(message != null&&message.equals("Login successful")){
                                        //Afficher un court message sur l'écran : Login réussi
                                        Toast.makeText(getApplicationContext(), "Login réussi", Toast.LENGTH_SHORT).show();
                                        //Récupérer la 2ème partie de la chaine splittée : elle contient les données renvoyées par le serveur
//                                        DatasExpert datasExpert = DatasExpert.getInstance();
//                                        datasExpert.setDatasExpert(msg[1]);
                                        System.out.println("Login Successfuly");
                                        //Créer une nouvelle activity dans l'application en utilisant un intent
                                        //un objet Intent permet de passer d'une activity à une autre u sein d'une même application
                                        Intent intent = new Intent(getApplicationContext(), AccueilExpert.class);
                                        //Lancer la nouvelle activity
                                        startActivity(intent);
                                        //Mettre fin à l'activity actuelle
                                        finish();
                                    }else{
                                        System.out.println("message message message");
                                        System.out.println(msg[0]);
                                        System.out.println(result);
                                        //Si la 1ère partie de la chaine splitée ne contient pas "SUCCESS" c'est que l'action a échoué (voir le fichier php)
                                        //Afficher un court message à l'écran avec l'erreur rencontrée
//                                        //Toast.makeText(getApplicationContext(), msg[1], Toast.LENGTH_SHORT).show();
                                    }
                                    //Si la réponse du serveur est incomplète afficher l'erreur rencontrée dans la console de LOG pour le débogage
                                    Log.i("Driss MSG", "Réponse du serveur = "+result);
                                }
                            }
                        }
                    });
                } else {
                    Toast.makeText(getApplicationContext(), "Tous les champs doivent être remplis", Toast.LENGTH_SHORT).show();
                }

            }
        });
    }
}
