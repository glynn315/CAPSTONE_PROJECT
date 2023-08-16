package com.example.mdrrmoapp;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.net.Uri;
import android.os.Bundle;
import android.view.View;
import android.widget.Toast;

public class MainActivity3 extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main3);
    }

    public void fireC(View view) {
        Uri u = Uri.parse("tel:" + "09638281253");

        Intent i = new Intent(Intent.ACTION_DIAL, u);

        try
        {
            startActivity(i);
        }
        catch (SecurityException s)
        {

            Toast.makeText(this, "An error occurred", Toast.LENGTH_LONG)
                    .show();
        }
    }

    public void ambu(View view) {
        Uri u = Uri.parse("tel:" + "09262869336");

        Intent i = new Intent(Intent.ACTION_DIAL, u);

        try
        {
            startActivity(i);
        }
        catch (SecurityException s)
        {

            Toast.makeText(this, "An error occurred", Toast.LENGTH_LONG)
                    .show();
        }
    }

    public void drr(View view) {
        Uri u = Uri.parse("tel:" + "09810851855");

        Intent i = new Intent(Intent.ACTION_DIAL, u);

        try
        {
            startActivity(i);
        }
        catch (SecurityException s)
        {

            Toast.makeText(this, "An error occurred", Toast.LENGTH_LONG)
                    .show();
        }
    }

    public void policecall(View view) {
        Uri u = Uri.parse("tel:" + "09067159915");

        Intent i = new Intent(Intent.ACTION_DIAL, u);

        try
        {
            startActivity(i);
        }
        catch (SecurityException s)
        {

            Toast.makeText(this, "An error occurred", Toast.LENGTH_LONG)
                    .show();
        }
    }
}