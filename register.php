<?php

require 'config.php';
require 'layout/header.php';

session_start();

security::InitSecurity();

require 'layout/nav.php';

?>

<!DOCTYPE html>
<html>

<body class="bg-gray-900 text-gray-100">
    <div class="container mx-auto w-2/4 p-20">
        <div class="bg-gray-800 p-8 pb-3 rounded-lg shadow-md">
            <div class="brand-logo pb-5">
                <?php require 'svg/register.php'; ?>
            </div>
            <form>
                <label class="block mb-2">
                    <div class="flex">
                        <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-900 border border-r-0 border-gray-500 dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600 rounded-l-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" height="20" width="20"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path fill="#ffffff" d="M96 128a128 128 0 1 0 256 0A128 128 0 1 0 96 128zm94.5 200.2l18.6 31L175.8 483.1l-36-146.9c-2-8.1-9.8-13.4-17.9-11.3C51.9 342.4 0 405.8 0 481.3c0 17 13.8 30.7 30.7 30.7H162.5c0 0 0 0 .1 0H168 280h5.5c0 0 0 0 .1 0H417.3c17 0 30.7-13.8 30.7-30.7c0-75.5-51.9-138.9-121.9-156.4c-8.1-2-15.9 3.3-17.9 11.3l-36 146.9L238.9 359.2l18.6-31c6.4-10.7-1.3-24.2-13.7-24.2H224 204.3c-12.4 0-20.1 13.6-13.7 24.2z" />
                            </svg>
                        </span>
                        <input type="text" name="username" id="username" class="border p-2 rounded-r-lg w-full bg-gray-900 border-gray-500" placeholder="ไอดี" required>
                    </div>
                </label>
                <label class="block mb-2">
                    <div class="flex">
                        <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-900 border border-r-0 border-gray-500 dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600 rounded-l-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" height="20" width="20"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path fill="#ffffff" d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z" />
                            </svg>
                        </span>
                        <input type="email" name="email" id="email" class="border p-2 rounded-r-lg w-full bg-gray-900 border-gray-500" placeholder="example@google.com" required>
                    </div>
                </label>
                <label class="block mb-2">
                    <div class="flex">
                        <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-900 border border-r-0 border-gray-500 dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600 rounded-l-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" height="20" width="20"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path fill="#ffffff" d="M336 352c97.2 0 176-78.8 176-176S433.2 0 336 0S160 78.8 160 176c0 18.7 2.9 36.8 8.3 53.7L7 391c-4.5 4.5-7 10.6-7 17v80c0 13.3 10.7 24 24 24h80c13.3 0 24-10.7 24-24V448h40c13.3 0 24-10.7 24-24V384h40c6.4 0 12.5-2.5 17-7l33.3-33.3c16.9 5.4 35 8.3 53.7 8.3zM376 96a40 40 0 1 1 0 80 40 40 0 1 1 0-80z" />
                            </svg>
                        </span>
                        <input type="password" name="password" id="password" class="border p-2 rounded-r-lg w-full bg-gray-900 border-gray-500" placeholder="รหัสผ่าน" required>
                    </div>
                </label>
                <label class="block mb-2">
                    <div class="flex">
                        <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-900 border border-r-0 border-gray-500 dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600 rounded-l-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" height="20" width="20"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path fill="#ffffff" d="M152 24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H64C28.7 64 0 92.7 0 128v16 48V448c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V192 144 128c0-35.3-28.7-64-64-64H344V24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H152V24zM48 192h80v56H48V192zm0 104h80v64H48V296zm128 0h96v64H176V296zm144 0h80v64H320V296zm80-48H320V192h80v56zm0 160v40c0 8.8-7.2 16-16 16H320V408h80zm-128 0v56H176V408h96zm-144 0v56H64c-8.8 0-16-7.2-16-16V408h80zM272 248H176V192h96v56z" />
                            </svg>
                        </span>
                        <input type="date" name="dateofbirth" id="dateofbirth" class="border p-2 rounded-r-lg w-full bg-gray-900 border-gray-500" placeholder="รหัสผ่าน" required>
                    </div>
                </label>
                <div>
                    <div class="flex justify-center pt-3 -mb-3">
                        <button type="submit" name="submit" id="submit" value="submit" onclick="RegisterSubmit(event)" class="bg-blue-500 text-white py-2 px-4 rounded-lg w-50 flex items-center
                            hover:bg-blue-700">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" height="20" width="20">
                                <g>
                                    <rect x="0.5" y="0.5" width="13" height="13" rx="1" fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round"></rect>
                                    <polygon points="8.5 10.5 8.5 7.5 10.5 7.5 7 3.5 3.5 7.5 5.5 7.5 5.5 10.5 8.5 10.5" fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round"></polygon>
                                </g>
                            </svg>
                            &nbsp;&nbsp;ตกลง&nbsp;&nbsp;
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

<script>
    function RegisterSubmit(event) {

        event.preventDefault();

        const username = document.getElementById('username');
        const email = document.getElementById('email');
        const password = document.getElementById('password');
        const dateofbirth = document.getElementById('dateofbirth');

        // Check if any required field is empty
        if (!username.value || !email.value || !password.value || !dateofbirth.value) {
            return; // Prevent the function from running
        }

        // Email format validation
        const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if (!emailPattern.test(email.value)) {
            RegisterFail("รูปแบบอีเมลไม่ถูกต้อง");
            return; // Prevent the function from running
        }

        axios.post('api/register.php', {
                username: username.value,
                email: email.value,
                password: password.value,
                dateofbirth: dateofbirth.value,
            }, {
                withCredentials: true // Ensure cookies are sent with the request
            })
            .then(respose => {
                if (respose.data.status === 'success') {
                    RegisterSuccess();
                    username.value = '';
                    email.value = '';
                    password.value = '';
                    dateofbirth.value = '';
                } else {
                    RegisterFail(respose.data.message);
                }
                setTimeout(() => {
                }, 2000);
            })
            .catch(error => {
                generalError(error);
            });
    };
</script>

</html>