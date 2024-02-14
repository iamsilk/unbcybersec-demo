<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dictionary Search</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center">Dictionary Search</h1>

        <form action="index.php" method="get">
            <div class="form-group">
                <label for="query">Enter a word:</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="query" name="query" required>
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </div>
        </form>

        <?php
        // Check if the search term is provided in the query parameters
        if (isset($_GET['query'])) {
            $query = $_GET['query'];
    
            // Open a process, specifying the command and options
            $descriptorspec = array(
                0 => array("pipe", "r"), // stdin
                1 => array("pipe", "w"), // stdout
                2 => array("pipe", "w")  // stderr
            );
    
            $process = proc_open("grep '$query' dictionary.txt", $descriptorspec, $pipes);
    
            if (is_resource($process)) {
                // Close stdin to signal that no more input will be sent to the process
                fclose($pipes[0]);
    
                // Read the output and error streams
                $stdout = stream_get_contents($pipes[1]);
                $stderr = stream_get_contents($pipes[2]);
    
                // Close all streams
                fclose($pipes[1]);
                fclose($pipes[2]);
    
                // Close the process
                $return_value = proc_close($process);
    
                // Display the results
                echo "<div class='mt-3'>";
                echo "<h2>Search Results:</h2>";
                echo "<pre class='bg-white p-3'>$stdout\n$stderr</pre>";
            }
        }
        ?>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>

</html>
