<style>
    .fixed-whatsapp-button {
        position: fixed;
        bottom: 20px;
        right: 20px;
        width: 60px;
        height: 60px;
        background-color: #25D366;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        transition: background-color 0.3s ease;
        z-index: 1000000;
    }

    .fixed-whatsapp-button a {
        color: white;
        font-size: 30px;
        text-decoration: none;
    }

    .fixed-whatsapp-button:hover {
        background-color: #128C7E;
    }
</style>

<body data-sidebar="dark" class="vertical-collpsed">
    <div class="fixed-whatsapp-button">
        <a href="https://wa.me/6282171469407?text=Halo%20Admin,%20saya%20ingin%20bertanya%20mengenai%20sistem%20ini.%20Berikut%20pertanyaan%20saya:" target="_blank">
            <i class="fab fa-whatsapp"></i><br>
        </a>
    </div>
    <!-- <body data-layout="horizontal" data-topbar="dark"> -->