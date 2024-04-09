<style>
    code {
        color:white;
    }
    .footer_share {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh; /* Adjust this value based on your layout */
    }
    .list-inline {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        gap: 10px; /* Adjust the gap between icons as needed */
    }
    .brand-name>div{
        display: grid;
        grid-template-columns: auto;
        justify-content: center;
    }
    .brand-name>div>a{
        display: grid;
        grid-template-columns: auto;
        justify-items: center;
    }
    .brand-name>div>ul{
        margin: auto;
    }
    .footer-row aside{
            display: grid;
            grid-template-columns: auto;
            justify-content: center;
    }
    @media (min-width: 768px) and (max-width: 1280px){
        .footer-row{
            display: grid;
            grid-template-columns: auto;
            justify-items: center;
        }
    }
</style>

<footer class="bg-dark" id="tempaltemo_footer" style="background-image: url(https://wujiateavn.com/images/bg_footer.png);">
    <div class="container" >
        <div class="row footer-row">
            <div class="col-md-3 pt-5 brand-name">
                <a href="<?php echo $rootPath?>"><img style="width: 50%;" class="mb-3 mx-auto" src="https://i.ibb.co/HDC7NHb/logo1.png" alt="logo.png"></a>
            </div>
            <div class="col-md-6 pt-5">
                <h4 class="border-bottom pb-3 border-light" style="color:black">Thông tin liên hệ</h4>
                <ul class="list-unstyled text-light footer-link-list">
                    <li>
                        <i class="fas fa-map-marker-alt fa-fw"></i>
                        <code>Địa chỉ: Đại học Bách Khoa, Bình Dương, Việt Nam</code>
                    </li>
                    <li>
                        <i class="fa fa-info-circle fa-fw"></i>
                        <code>Nhượng quyền: <a class="text-decoration-none" href="tel:0123456789"><span style="color: #ffff00">0123-456-789</a> (Thứ 2 - Thứ 7 / 8:00 AM - 17:00 PM)  </span></code>
                    </li>
                    <li>
                        <i class="fa fa-phone fa-fw"></i>
                        <code>Điện thoại: </code><a class="text-decoration-none text-light" href="tel:0123456789"><code><span style="color: #ffff00">0123-456-789</span></code></a>
                    </li>
                    <li>
                        <i class="fa fa-envelope fa-fw"></i>
                        <code>Email: </code><a class="text-decoration-none text-light" href="mailto:vanhoatruyenthong@thaco.com.vn"><code>vanhoatruyenthong@thaco.com.vn</code></a>
                    </li>
                </ul>
            </div>
            <div class="col-md-3 pt-5">
                <aside>
                    <!-- Include the Facebook SDK -->
                    <script async defer src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v11.0" nonce="YOUR_NONCE_VALUE"></script>

                    <!-- Embed the Facebook Like Box -->
                    <div class="fb-like-box"
                        data-href="https://www.facebook.com/TapdoanTruongHai.THACO"
                        data-width="320"
                        data-height="450"
                        data-colorscheme="light"
                        data-show-faces="true"
                        data-header="false"
                        data-stream="false"
                        data-show-border="false">
                    </div>
                </aside>
            </div>
        </div>
    </div>

    <div class="w-100 py-1" style="background-color: #058dbf">
        <div class="container">
            <div class="row pt-2">
                <div class="col-12">
                    <p class="text-center text-light user-select-none">
                        <code>Copyright &copy; 2024 Bài tập lớn Lập trình nâng cao (CO2039)</code>
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>