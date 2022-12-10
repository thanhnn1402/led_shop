'use stricts'

const app = () => {

    //function set background image
    (() => {
        const dataImages = document.querySelectorAll('.set-bg');
        dataImages.forEach((data, index) => {
            const attImage = data.getAttribute('data-bg');
            
            data.style.backgroundImage = `url("${attImage}")`;
        })
    })();

    //OnScroll
    if(document.querySelector('.back-to-top') && document.querySelector('.navbar')) {
        const backToTop = document.querySelector('.back-to-top');
        const navbar = document.querySelector('.navbar');
        window.onscroll = () => {
            if(window.pageYOffset > 100) {
                navbar.classList.add('fixed-navbar');

                backToTop.style.opacity = 1;

                document.querySelector('.main-banner').style.marginTop = '100px';
            } else if (window.pageYOffset < 10){
                navbar.classList.remove('fixed-navbar');

                backToTop.style.opacity = 0;

                document.querySelector('.main-banner').style.marginTop = '0';

            }

        }
    }


    // show password
    if(document.querySelectorAll('.show-password')) {
        const btnShowPassword = document.querySelectorAll('.show-password');
        btnShowPassword.forEach((item, index) => {
            const parent = item.parentElement;
            item.onclick = () => {
                if(item.querySelector('i').className === 'fa-regular fa-eye-slash') {
                    item.querySelector('i').className = 'fa-regular fa-eye';
                    parent.querySelector('input[type="password"]').type = 'text';
                } else {
                    item.querySelector('i').className = 'fa-regular fa-eye-slash';
                    parent.querySelector('input[type="text"]').type = 'password';
                }

            }
        })
    }

    // show / close sidebar admin
    if(document.querySelector('.btn-show-sidebar')) {
        const btnSidebar = document.querySelector('.btn-show-sidebar');
        const sideBar = document.querySelector('.main-sidebar');
        const content = document.querySelector('.main-content');

        btnSidebar.onclick = () => {
            if(sideBar.className === 'main-sidebar show') {
                sideBar.classList.remove('show');
                content.style.marginLeft = 0;
            } else {
                sideBar.classList.add('show');
                content.style.marginLeft = 250 + 'px';
            }
        }

        if(window.pageXOffset < 1024) {
            sideBar.classList.remove('show');
            content.style.marginLeft = 0;
        }
    }
    
}

// read input file img
function readFileImg(selector) {
    const imgGrid = document.querySelector(`${selector} .img-grid`);
    const reader = new FileReader();
    
    const inputFile = document.querySelector(`${selector} .form-group input[type="file"]`);

    inputFile.addEventListener('change', (event) => {
        const file = event.target.files[0];

        reader.addEventListener("load", function(event) {
            if(imgGrid.querySelector('img')) {
                const img = imgGrid.querySelector('img');
                img.setAttribute('src', event.target.result);
                img.style.width = "100%";
            } else {
                const img = document.createElement('img');
                img.setAttribute('src', event.target.result);
                img.style.width = "100%";
                imgGrid.appendChild(img);
            }

            
        })

        reader.readAsDataURL(file);
    });
}

// counter

function counter(selector) {
    const data = document.querySelectorAll(`${selector} tbody .counter`);
    data.forEach((item, index) => {
        item.innerText = index + 1;
    })
}

app();