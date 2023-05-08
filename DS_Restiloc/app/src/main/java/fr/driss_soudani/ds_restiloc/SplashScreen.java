package fr.driss_soudani.ds_restiloc;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;


import fr.driss_soudani.ds_restiloc.R;

public class SplashScreen extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.splash_screen);

        //Rediriger vers la page principale "MainActivity" après 3s
        Runnable runnable = new Runnable() {
            @Override
            public void run() {
                //Démarrer une page en créant un intent et en le redirigeant ver la classe MainActivity
                Intent intent = new Intent(getApplicationContext(), Login.class);
                //Lancer l'intent précédement créé
                startActivity(intent);
                //Terminer l'activité en cours (Le Splash)
                finish();
            }
        };
        //Handler
        new Handler().postDelayed(runnable, 3000);
    }




}