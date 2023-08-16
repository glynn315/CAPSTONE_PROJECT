package com.example.mdrrmoapp;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.net.ConnectivityManager;
import android.os.Bundle;
import android.os.Handler;

public class splashActivity extends AppCompatActivity {
    public static int SPLASH_TIME = 1000;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_splash);

        new Handler().postDelayed(new Runnable() {
            @Override
            public void run() {
                SharedPreferences shared = getSharedPreferences(MainActivity.PREFS,0);
                boolean hasLoggedin = shared.getBoolean("hasLoggedin" , true);
                if (checkInternet()==true)
                {
                    Intent in = new Intent(splashActivity.this,MainActivity.class);
                    startActivity(in);
                    finish();
                }
                else
                {
                    Intent in = new Intent(splashActivity.this,MainActivity3.class);
                    startActivity(in);
                    finish();
                }

            }
        },SPLASH_TIME);
    }
    public boolean checkInternet()
    {
        ConnectivityManager manager = (ConnectivityManager) getApplicationContext().getSystemService(Context.CONNECTIVITY_SERVICE);
        return manager.getActiveNetworkInfo()!=null && manager.getActiveNetworkInfo().isConnectedOrConnecting();
    }
}