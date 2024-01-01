public class Main {
    public static void main(String[] args) {
            String programVerson = "1.4";
            String ProgramId = "2";
            CheckKey keyChecker = new CheckKey();
            String LicenceValue = keyChecker.checkKey("73n2", programVerson,ProgramId);
            System.out.println(LicenceValue);
            System.out.println("Hello world!");

    }
}