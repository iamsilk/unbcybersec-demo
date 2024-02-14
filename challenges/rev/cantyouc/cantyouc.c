#include <stdio.h>
#include <string.h>

int checkSubstr(char* str1, char* str2, int len)
{
    for (int i = 0; i < len; i++)
    {
        if (str1[i] != str2[i])
        {
            return 0;
        }
    }
    return 1;
}

int main()
{
    char input[100];
    printf("If you can see, prove it: ");
    
    scanf("%99s", input);

/*
demo{y0u_c4n_s33_m3?_i_d0nt_b3l1v3_1t!}

demo{y0
u_c4n
_s33_m
3?_i_d
0nt_b
3l1v3
_1t!}
*/

    if (strlen(input) == 39
        && checkSubstr(input + 12, "_s33_m", 6)
        && checkSubstr(input, "demo{y0", 7)
        && checkSubstr(input + 34, "_1t!}", 5)
        && checkSubstr(input + 29, "3l1v3", 5)
        && checkSubstr(input + 7, "u_c4n", 5)
        && checkSubstr(input + 18, "3?_i_d", 6)
        && checkSubstr(input + 24, "0nt_b", 5))
    {
        printf(":O\n");
    }
    else
    {
        printf("Nope >:)\n");
    }
}