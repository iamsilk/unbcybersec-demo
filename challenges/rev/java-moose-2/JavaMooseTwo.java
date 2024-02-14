import java.util.Scanner;

public class JavaMooseTwo {
    public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in);

        String password = "qwertyuiop";
        String flagEncrypted = "1512081d0f1d460a5f1d014609433a402a583c2f2125564543002a225c271d56440f";

        System.out.print("Enter the password: ");
        String inputPassword = scanner.nextLine();

        if (inputPassword.equals(password)) {
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
}