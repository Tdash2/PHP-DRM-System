import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;
import java.net.URLEncoder;
import java.net.NetworkInterface;
import java.net.SocketException;
import java.util.Enumeration;
public class CheckKey {
    public String checkKey(String license, String ver, String ProductId) {
        System.out.println("Checking Licence Key Please Wait...");
        try {
            String uniqueIdentifier = null;
            try {
                Enumeration<NetworkInterface> networkInterfaces = NetworkInterface.getNetworkInterfaces();
                StringBuilder identifierBuilder = new StringBuilder();
                while (networkInterfaces.hasMoreElements()) {
                    NetworkInterface networkInterface = networkInterfaces.nextElement();
                    byte[] mac = networkInterface.getHardwareAddress();
                    if (mac != null) {
                        for (byte b : mac) {
                            identifierBuilder.append(String.format("%02X", b));
                        }
                    }
                }
                uniqueIdentifier = identifierBuilder.toString();
            } catch (SocketException e) {
                e.printStackTrace();
            }
            String encodedLicense = URLEncoder.encode(license, "UTF-8");
            String serverUrl = "https://drm.example.com/actvate/?key=" + encodedLicense+"&hwid=" + uniqueIdentifier + "&pid=" + ProductId;
            URL url = new URL(serverUrl);
            HttpURLConnection connection = (HttpURLConnection) url.openConnection();
            connection.setRequestProperty("User-Agent", "AquaStreams Director Version "+ver);
            connection.setRequestMethod("GET");
            int responseCode = connection.getResponseCode();
            if (responseCode == 400) {
                System.out.println("Error: The licence key is not valued because: Bad key format!");
                System.exit(1);
            }
            else
            if (responseCode == 201) {
                BufferedReader reader = new BufferedReader(new InputStreamReader(connection.getInputStream()));
                String Owner;
                String level;
                String expire;
                String verson;
                String outOfDate;
                String message = "";
                Owner = reader.readLine();
                level = reader.readLine();
                expire = reader.readLine();

                verson = reader.readLine();
                outOfDate = reader.readLine();

                String levelNiceName = null;
                System.out.println("Software Is licenced to: " + Owner);
                if(Integer.valueOf(level) == 1){
                    levelNiceName = "Basic";
                }
                if(Integer.valueOf(level) == 2){
                    levelNiceName = "Intermediate";
                }
                if(Integer.valueOf(level) == 3){
                    levelNiceName = "Advanced";
                }
                System.out.println("Program licence level: " + levelNiceName);
                System.out.println("Program licence For: " + expire);
                System.out.println("------------------------------------");
                if(!(ver.equals(verson))){
                    System.out.println("You Program is out of date! Here is the change log:");
                    String line;
                    while ((line = reader.readLine()) != null) {
                        System.out.println("• "+line);
                    }
                    System.out.println("------------------------------------");
                    System.out.println(outOfDate);
                    System.out.println("------------------------------------");
                }
                return level;
            } else {
                BufferedReader reader = new BufferedReader(new InputStreamReader(connection.getInputStream()));
                String error;
                error = reader.readLine();
                System.out.println("Error: The licence key is not valued because: " + error);
                System.exit(1);
                return null;
            }
            connection.disconnect();
        } catch (IOException e) {
            System.out.println("Error: The licence key is not valued because: Cannot connect to server");
            e.printStackTrace();
            System.exit(1);
            return null;
        }
        return null;
    }
}