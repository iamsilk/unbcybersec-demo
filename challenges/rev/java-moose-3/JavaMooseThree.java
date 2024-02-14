import java.util.Scanner;
import java.security.MessageDigest;
import java.security.NoSuchAlgorithmException;
import java.nio.charset.StandardCharsets;

public class JavaMooseThree {
    public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in);

        String passwordHash = "1f578606eb0a178927deb51f7348e82acf8d711d369f710c7ac202c00d5ce9b8";
        String flagEncrypted = "0d0902191e4e07146f223356192a1d2146125b331619302604346f5e332b193a4e073555361b5e410d261d464005333f17574b381a732d5e41584b5712";

        System.out.print("Enter the password: ");
        String inputPassword = scanner.nextLine();
        String inputPasswordHash = shaHash(inputPassword);

        if (inputPasswordHash.equals(passwordHash)) {
            String flag = xorStrings(inputPassword, hexStringToByteArray(flagEncrypted));
            System.out.println("Password correct! The flag is: " + flag);
        } else {
            System.out.println("Incorrect password. Access denied.");
        }

        scanner.close();
    }

    private static String xorStrings(String s1, byte[] s2) {
        int length = Math.max(s1.length(), s2.length);
        StringBuilder result = new StringBuilder(length);

        for (int i = 0; i < length; i++) {
            char c1 = s1.charAt(i % s1.length());
            byte c2 = s2[i % s2.length];

            result.append((char) (c1 ^ c2));
        }

        return result.toString();
    }

    private static byte[] hexStringToByteArray(String hexString) {
        int length = hexString.length();
        if (length % 2 != 0) {
            throw new IllegalArgumentException("Hex string must have an even number of characters");
        }

        byte[] byteArray = new byte[length / 2];
        for (int i = 0; i < length; i += 2) {
            byteArray[i / 2] = (byte) ((Character.digit(hexString.charAt(i), 16) << 4)
                                  + Character.digit(hexString.charAt(i + 1), 16));
        }

        return byteArray;
    }

    private static String shaHash(String input) {
        try {
            MessageDigest md = MessageDigest.getInstance("SHA-256");
            byte[] hashBytes = md.digest(input.getBytes(StandardCharsets.UTF_8));

            // Convert byte array to hexadecimal representation
            StringBuilder hexStringBuilder = new StringBuilder();
            for (byte b : hashBytes) {
                hexStringBuilder.append(String.format("%02x", b));
            }

            return hexStringBuilder.toString();
        } catch (NoSuchAlgorithmException e) {
            // Handle the exception (e.g., log or throw a runtime exception)
            e.printStackTrace();
            return null;
        }
    }
}