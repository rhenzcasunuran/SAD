<?php

namespace App\Controllers;

class ManageRedirectController {

    protected function residentCheckIfNotSession() 
    {
        if (!isset($_SESSION['session_resident_id'])) {
            $this->redirectTo('index');
            exit();
        }
    }

    protected function residentCheckIfSession() 
    {
        if (isset($_SESSION['session_resident_id'])) {
            $this->redirectTo('personal-information');
            exit();
        }
    }

    protected function redirectTo($page) 
    {
        $redirectionUrl = $this->buildRedirectUrl($page);

        // Sanitize and validate the redirection URL
        $sanitizedUrl = filter_var($redirectionUrl, FILTER_SANITIZE_URL);
        if (filter_var($sanitizedUrl, FILTER_VALIDATE_URL)) {
            // Redirect to the sanitized URL
            header("Location: $sanitizedUrl");
            exit();
        } else {
            // Redirect to a default page or show an error message
            $this->redirectToDefaultPage();
        }
    }

    private function buildRedirectUrl($page)
    {
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
        $host = $_SERVER['HTTP_HOST'];
        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        return $protocol . $host . $uri . '/index.php?page=' . $page;
    }

    private function redirectToDefaultPage()
    {
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
        $host = $_SERVER['HTTP_HOST'];
        $location = $protocol . $host . '/index.php';
        header('Location: ' . $location);
        exit();
    }
}