<?php
    require_once('../php/main.php');

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        protectedEndpoint();
    } else {
        http_response_code(404); // Not Found
    }

    echo '<pre>';
    print_r(getallheaders());
    echo '</pre>';

    if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
        echo "Authorization header via \$_SERVER['HTTP_AUTHORIZATION']: " . $_SERVER['HTTP_AUTHORIZATION'];
    } else {
        echo "Authorization header not found in \$_SERVER['HTTP_AUTHORIZATION']";
    }
?>

<!-- curl -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJhdWQiOiJsb2NhbGhvc3QiLCJpYXQiOjE3MTY2ODAwMjksImV4cCI6MTcxNjY4MzYyOSwidXNlcklkIjoxfQ.pemkIgW0BG4LBSvaFmUWQGr_cdRSDVuqhsWP2NdXNds" http://localhost/itc_project/pages/check_headers.php -->
