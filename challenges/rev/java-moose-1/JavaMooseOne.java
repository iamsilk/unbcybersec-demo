import java.util.Scanner;

public class JavaMooseOne {
    public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in);

        String password = "anthony1";
        String flag = "demo{d3c0mp1l1N9_1S_PR377y_K3Wl!!}";

        System.out.print("Enter the password: ");
        String inputPassword = scanner.nextLine();

        if (inputPassword.equals(password)) {
            System.out.println("Password correct! The flag is: " + flag);
        } else {
            System.out.println("Incorrect password. Access denied.");
        }

        scanner.close();
    }
}