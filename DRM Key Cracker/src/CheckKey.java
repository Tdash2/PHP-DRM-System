import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;
import java.net.URLEncoder;

public class CheckKey {
    public String checkKey(String license) {
        try {
            String uniqueIdentifier = null;
            String encodedLicense = URLEncoder.encode(license, "UTF-8");

            String serverUrl = "https://"+ Main.Serverdomain+"/actvate/?key=" + encodedLicense+"&hwid="+ Main.HWID+"&pid="+ Main.PID ;
            URL url = new URL(serverUrl);
            HttpURLConnection connection = (HttpURLConnection) url.openConnection();
            connection.setRequestProperty("User-Agent", "DRM Spammer");
            connection.setRequestMethod("GET");
            int responseCode = connection.getResponseCode();

            if (responseCode == 400) {}else
            if (responseCode == 201) {
                BufferedReader reader = new BufferedReader(new InputStreamReader(connection.getInputStream()));
                String Owner;
                String level;
                String expire;
                Owner = reader.readLine();
                level = reader.readLine();
                expire = reader.readLine();
                String levelNiceName = null;
                long endTime = System.currentTimeMillis();
                long seconds = endTime / 1000;

                System.out.println("It took "+Main.seconds+ " seconds to find a the working key " + encodedLicense);
                System.exit(1);
                return String.valueOf(Main.seconds);

            } else {
                BufferedReader reader = new BufferedReader(new InputStreamReader(connection.getInputStream()));
                String error;
                error = reader.readLine();
                Main.requests++;
                return null;
            }
            connection.disconnect();
        } catch (IOException e) {

        }
        return null;
    }
}