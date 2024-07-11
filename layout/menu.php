<?php 
?>

<body class="bg-gray-900 text-gray-100">
    <div class="container mx-auto p-4">
    </div>

    <div class="dock">
        <div class="block justify-between md:flex md:justify-between">

            <div class="user-info md:pr-8">
                <div class="flex flex-col items-center justify-center">
                        <p><?php echo $_SESSION['userid']; ?></p>
                        <p>[<?php echo number_format($_SESSION['account_id']); ?>]</p>
                </div>
            </div>

            <div class="nav-icons">
                <a href="home.php">
                    <div class="icon-wrapper relative">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" width="50px" hieght="50px">
                            <path fill="#ffffff" d="M543.8 287.6c17 0 32-14 32-32.1c1-9-3-17-11-24L512 185V64c0-17.7-14.3-32-32-32H448c-17.7 0-32 14.3-32 32v36.7L309.5 7c-6-5-14-7-21-7s-15 1-22 8L10 231.5c-7 7-10 15-10 24c0 18 14 32.1 32 32.1h32v69.7c-.1 .9-.1 1.8-.1 2.8V472c0 22.1 17.9 40 40 40h16c1.2 0 2.4-.1 3.6-.2c1.5 .1 3 .2 4.5 .2H160h24c22.1 0 40-17.9 40-40V448 384c0-17.7 14.3-32 32-32h64c17.7 0 32 14.3 32 32v64 24c0 22.1 17.9 40 40 40h24 32.5c1.4 0 2.8 0 4.2-.1c1.1 .1 2.2 .1 3.3 .1h16c22.1 0 40-17.9 40-40V455.8c.3-2.6 .5-5.3 .5-8.1l-.7-160.2h32z" />
                        </svg>
                        <div class="tooltip">หน้าหลัก</div>
                    </div>
                </a>
                <a href="#" onclick="Loggout(event)">
                    <div class="icon-wrapper relative">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="50px" hieght="50px">
                            <path fill="#ffffff" d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 192 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l210.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128zM160 96c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 32C43 32 0 75 0 128L0 384c0 53 43 96 96 96l64 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l64 0z" />
                        </svg>
                        <div class="tooltip">ออกจากระบบ</div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</body>

<script>
    function Loggout(event) {
        axios.post('api/logout.php', {}, {
                withCredentials: true
            })
            .then(response => {
                window.location.href = "index.php?code=logout";
            })
            .catch(error => {
                ShowErrorToastMessasge(error);
            });
    }

    document.addEventListener('DOMContentLoaded', () => {
        const iconWrappers = document.querySelectorAll('.icon-wrapper');

        iconWrappers.forEach(wrapper => {
            const tooltip = wrapper.querySelector('.tooltip');
            wrapper.addEventListener('mouseenter', () => {
                tooltip.style.visibility = 'visible';
                tooltip.style.opacity = '1';
            });

            wrapper.addEventListener('mouseleave', () => {
                tooltip.style.visibility = 'hidden';
                tooltip.style.opacity = '0';
            });
        });
    });
</script>