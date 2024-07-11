<?php

require 'config.php';
require 'layout/header.php';

session_start();

security::InitSecurity();

require 'layout/nav.php';

member::alreadyLoggedIn();

?>

<!DOCTYPE html>
<html>

<body class="bg-gray-900 text-gray-100">
    <nav>
        <div style="height:40px;width:40px;position:fixed;right:1%;top:1%;">
            <a href="#" target="_blank" rel="noopener noreferrer"></a>
        </div>
    </nav>

    <div class="container mx-auto w-2/4 p-20">
        <div class="bg-gray-800 p-8 pb-3 rounded-lg shadow-md">
            <div class="brand-logo pb-5">
                <?php require 'svg/login.php'; ?>
            </div>
            <form>
                <label class="block mb-2">
                    <div class="flex">
                        <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-900 border border-r-0 border-gray-500 dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600 rounded-l-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" height="20" width="20"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path fill="#ffffff" d="M96 128a128 128 0 1 0 256 0A128 128 0 1 0 96 128zm94.5 200.2l18.6 31L175.8 483.1l-36-146.9c-2-8.1-9.8-13.4-17.9-11.3C51.9 342.4 0 405.8 0 481.3c0 17 13.8 30.7 30.7 30.7H162.5c0 0 0 0 .1 0H168 280h5.5c0 0 0 0 .1 0H417.3c17 0 30.7-13.8 30.7-30.7c0-75.5-51.9-138.9-121.9-156.4c-8.1-2-15.9 3.3-17.9 11.3l-36 146.9L238.9 359.2l18.6-31c6.4-10.7-1.3-24.2-13.7-24.2H224 204.3c-12.4 0-20.1 13.6-13.7 24.2z" />
                            </svg>
                        </span>
                        <input type="text" name="username" id="username" class="border p-2 rounded-r-lg w-full bg-gray-900 border-gray-500" placeholder="user" required>
                    </div>
                </label>
                <label class="block mb-2">
                    <div class="flex">
                        <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-900 border border-r-0 border-gray-500 dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600 rounded-l-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" height="20" width="20"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path fill="#ffffff" d="M336 352c97.2 0 176-78.8 176-176S433.2 0 336 0S160 78.8 160 176c0 18.7 2.9 36.8 8.3 53.7L7 391c-4.5 4.5-7 10.6-7 17v80c0 13.3 10.7 24 24 24h80c13.3 0 24-10.7 24-24V448h40c13.3 0 24-10.7 24-24V384h40c6.4 0 12.5-2.5 17-7l33.3-33.3c16.9 5.4 35 8.3 53.7 8.3zM376 96a40 40 0 1 1 0 80 40 40 0 1 1 0-80z" />
                            </svg>
                        </span>
                        <input type="password" name="password" id="password" class="border p-2 rounded-r-lg w-full bg-gray-900 border-gray-500" placeholder="password" required>
                    </div>
                </label>
                <div>
                    <div class="flex justify-center pt-3 -mb-3">
                        <button type="submit" name="submit" id="submit" value="submit" onclick="RegisterSubmit(event)" class="bg-purple-500 text-white py-2 px-4 rounded-lg w-50 flex items-center hover:bg-purple-700">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" height="20" width="20"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#ffffff" d="M352 96l64 0c17.7 0 32 14.3 32 32l0 256c0 17.7-14.3 32-32 32l-64 0c-17.7 0-32 14.3-32 32s14.3 32 32 32l64 0c53 0 96-43 96-96l0-256c0-53-43-96-96-96l-64 0c-17.7 0-32 14.3-32 32s14.3 32 32 32zm-9.4 182.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L242.7 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l210.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128z"/></svg>
                            &nbsp;&nbsp;ตกลง&nbsp;&nbsp;
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

<script>
    $(document).ready(function() {
        const code = new URLSearchParams(window.location.search).get('code');

        if (code == "login")
            RegisterFail("โปรดทำการ Login ก่อน");

        if (code == "logout")
            generalSuccess("ออกจากระบบ");

        if (code == 'force')
            unverifySecurity();

        window.history.replaceState({}, document.title, window.location.pathname);
    });

    function RegisterSubmit(event) {

        event.preventDefault();

        const username = document.getElementById('username');
        const password = document.getElementById('password');

        if (!username.value || !password.value) {
            return;
        }

        axios.post('api/login.php', {
                username: username.value,
                password: password.value,
            }, {
                withCredentials: true
            })
            .then(respose => {
                if (respose.data.status === 'success') {
                    generalSuccess(respose.data.message);
                    username.value = '';
                    password.value = '';
                } else {
                    RegisterFail(respose.data.message);
                }
                setTimeout(() => {
                    window.location.href = "home.php";
                }, 1500);
            })
            .catch(error => {
                generalError(error);
            });
    };
</script>

</html>