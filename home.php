<?php

require 'config.php';

require 'layout/header.php';

session_start();

security::InitSecurity();

member::checkLoggedInUser();

security::Bearer(Bearer::LOGIN);

require 'layout/menu.php';

$user = query::Get(TABLE_USER, ['account_id' => $_SESSION['account_id']]);

?>

<body class="bg-gray-900 text-gray-100 h-screen flex items-center justify-center">
    <div class="container mx-auto p-4 mt-10 w-3/6">
        <div class="grid grid-cols-1">
            <!-- User Info Card -->
            <div class="bg-gray-800 p-4 rounded shadow-lg">
                <h2 class="text-2xl font-bold mb-4">รายละเอียด User</h2>
                <p>username: <?php echo $_SESSION['userid']; ?> (<?php echo $_SESSION['account_id']; ?>)</p>
                <p>Email: <?php echo $user['email']; ?></p>
                <!-- Change Password Button -->
                <button class="mt-4 bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded" onclick="openModal()">เปลี่ยนรหัสผ่าน</button>
            </div>
        </div>

        <div class="grid grid-cols-1 mt-4">
            <!-- Extra Panel 1 -->
            <div class="bg-gray-800 p-4 rounded shadow-lg">
                <h2 class="text-2xl font-bold mb-4">รายละเอียดเพิ่มเติม</h2>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="modal" class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center hidden">
        <div class="bg-gray-800 p-6 rounded-lg shadow-lg w-96">
            <h2 class="text-xl font-bold mb-4">เปลี่ยนรหัสผ่าน</h2>
            <form id="changePasswordForm">
                <div class="mb-4">
                    <label for="current_password" class="block text-sm font-medium text-gray-300">รหัสผ่านปัจจุบัน</label>
                    <input type="password" name="current_password" id="current_password" class="bg-gray-900 text-gray-300 block w-full p-2 rounded mt-1">
                </div>
                <div class="mb-4">
                    <label for="new_password" class="block text-sm font-medium text-gray-300">รหัสผ่านใหม่</label>
                    <input type="password" name="new_password" id="new_password" class="bg-gray-900 text-gray-300 block w-full p-2 rounded mt-1">
                </div>
                <div class="mb-4">
                    <label for="confirm_password" class="block text-sm font-medium text-gray-300">ยืนยันรหัสผ่านใหม่</label>
                    <input type="password" name="confirm_password" id="confirm_password" class="bg-gray-900 text-gray-300 block w-full p-2 rounded mt-1">
                </div>
                <div class="flex justify-end">
                    <button type="button" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2" onclick="closeModal()">ยกเลิก</button>
                    <button type="button" onclick="submitForm()" class="bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded">บันทึก</button>
                </div>
            </form>
        </div>
    </div>
</body>

<script>
    function openModal() {
        document.getElementById('modal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('modal').classList.add('hidden');
    }

    function submitForm() {
        const currentPassword = document.getElementById('current_password').value;
        const newPassword = document.getElementById('new_password').value;
        const confirmPassword = document.getElementById('confirm_password').value;

        axios.post('api/change_pass.php', {
            current_password: currentPassword,
            new_password: newPassword,
            confirm_password: confirmPassword
        }, {
            withCredentials: true
        })
        .then(response => {
            if(response.data.status === "success") {
                generalSuccess(response.data.message);
                closeModal();
                // clear form
                document.getElementById('current_password').value = '';
                document.getElementById('new_password').value = '';
                document.getElementById('confirm_password').value = '';
            }

            if(response.data.status === "fail") {
                generalError(response.data.message);
            }
        })
        .catch(error => {});
    }    
</script>

<?php

require 'layout/footer.php';

?>