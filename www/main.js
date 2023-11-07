function myFunction() {
    document.querySelector(".registration-container").classList.toggle("active-regis");
}

function myFunction() {
    document.querySelector(".box").classList.toggle(".active-nav");
}

var loadFile = function (event) {
    var cur = String(event.target.id).split('-');
    var side = cur[cur.length - 1]; // get side {font-back} of id card
    var imageDisplay = document.getElementById(`output_${side}`);
    imageDisplay.src = URL.createObjectURL(event.target.files[0]);
    imageDisplay.classList.remove('hidden');
    document.getElementById('upload-image-front').classList.add('hidden');
};

// Next/previous controls
function plusSlides(n) {
    showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
    showSlides(slideIndex = n);
}

function slide_show() {
    let i = 1;
    var shows = setInterval(() => {
        plusSlides(i);
    }, 1000)

    let is_stop = false

    $('.dot').click(function () {
        clearInterval(shows)
        if (!is_stop) {
            clearTimeout(stop)
            stop = setTimeout(() => {
                shows = setInterval(() => {
                    plusSlides(1)
                    is_stop = false
                }, 2000)
            }, 3000)
        }

        is_stop = true
    })

    $('.prev').click(function () {
        clearInterval(shows)
        if (!is_stop) {
            clearTimeout(stop)
            stop = setTimeout(() => {
                shows = setInterval(() => {
                    plusSlides(1)
                    is_stop = false
                }, 2000)
            }, 3000)
        }

        is_stop = true
    })

    $('.next').click(function () {
        clearInterval(shows)
        if (!is_stop) {
            clearTimeout(stop)
            stop = setTimeout(() => {
                shows = setInterval(() => {
                    plusSlides(1)
                    is_stop = false
                }, 2000)
            }, 3000)
        }
        is_stop = true
    })
}

function showSlides(n) {
    let i;
    let slides = document.getElementsByClassName("mySlides");
    let dots = document.getElementsByClassName("dot");
    if (n > slides.length) { slideIndex = 1 }
    if (n < 1) { slideIndex = slides.length }
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }

    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].className += " active";
}

function checkAuthentication(username) {
    $('#header .navbar-item:not(:first-child) .item-link').click(element => {
        element.preventDefault();
        $.ajax({
            url: './admin/GetStateOfUser.php',
            type: 'post',
            data: {
                username: username
            },
            success: function (data) {
                if (data == 0) {
                    show_toast('Tính năng này chỉ dành cho các tài khoản đã được xác minh');
                } else {
                    window.location.replace($(element.target).attr('href'))
                }
            }
        })

    });
}

function show_toast(message, type = 0) {
    $('.toast').remove();
    $('body').append(
        `
        <div class="toast ${type == 0 ? "toast-danger" : "toast-success"}">
            <i class="fa-solid fa-circle-exclamation toast-icon"></i>
            <p class="message">${message}</p>
        </div>
        `
    )

    $('.toast').fadeIn();
    $('.toast').fadeOut(3000);
}

// Using on admin's site
function getPageIndex() {
    return $('.page-item.active').text().trim();
}

function getUsers() {
    $.ajax({
        url: './admin/admin_function/GetUserAdmin.php',
        type: 'GET',
        data: {
            page: getPageIndex()
        },
        success: function (data) {
            fillData(data)
        }
    })
}

function changePage() {
    $('.page-item').click(function () {
        clearClass('.page-item', 'active');
        const pageText = $(this).text().trim();

        if (pageText != '1') {
            $('.page-link:contains("Previous")').parent().removeClass('disabled')
        } else {
            $('.page-link:contains("Previous")').parent().addClass('disabled')
        }

        if ($.isNumeric(pageText)) {
            $(this).addClass('active');
        }
    })
}

function clearClass(target, cls) {
    $(target).each(function (element) {
        $(this).removeClass(cls);
    })
}

function fillData(data) {
    const json = JSON.parse(data);
    const statusCode = json['status'];
    const users = json['response'];

    if (statusCode == 1) {
        let i = 1;
        users.forEach(user => {
            check_state = ''
            lock_state = ''
            if (user['state'] == 1) {
                check_state = 'disabled';
            } else {
                lock_state = 'disabled';
            }
            $('#control-panel tbody').append(`
                <tr>
                    <th scope="row">${i}</th>
                    <td>${user['username']}</td>
                    <td>${user['email']}</td>
                    <td>${user['fullname']}</td>
                    <td>${user['phonenumber']}</td>
                    <td>
                        <i class="btn btn-info btn-sm fa-solid fa-eye-slash show-modal" data-toggle="modal"
                            data-target="#show-id-card"></i>
                    </td>
                    <td>
                        <i class="btn btn-success fa-solid fa-check accept ${check_state}"></i>
                        <i class="btn btn-danger fa-solid fa-lock text-white lock ${lock_state}"></i>
                    </td>
                </tr>
            `)

            i++;
        });
    }
}


// Use on user info site
function get_information() {
    $.ajax({
        url: './admin/GetUserName.php',
        dataType: 'json',
        type: 'get',
        data: {
            token: get_cookie()
        },
        success: function (data) {
            console.log(data);
            fill_data(data[0]);
        },
        error: (err) => {
            console.log(err);
        }
    })
}

function fill_data(data) {
    $('#fullname').text(data.FullName);
    $('#phonenumber').text(data.Phone);
    $('#email').text(data.Email);
    $('#birthday').text(data.Birthday);
    $('#balance').text(data.balance);

    if (data.state == 0) {
        $('#state').text('Chưa xác minh');
        $('#icon-state').addClass('fa-triangle-exclamation');
    } else if (data.state == 2) {
        $('#state').text('Tài khoản tạm thời bị khóa');
        $('#icon-state').addClass('fa-clock');
    } else if (data.state == 3) {
        $('#state').text('Tài khoản tạm thời bị khóa');
        $('#icon-state').addClass('fa-lock');
    } else {
        $('#state').text('Đã xác minh');
        $('#icon-state').addClass('fa-circle-check');
    }
}

function get_profile(username) {
    $.ajax({
        url: './admin/GetUserName.php',
        dataType: 'json',
        type: 'get',
        data: {
            username: username
        },
        success: function (data) {
            fill_profile(data[0]);
        },
        error: (err) => {
            console.log(err);
        }
    })
}

function fill_profile(data) {
    $('#fullname').text(data.FullName);
    $('#phonenumber').text(data.Phone);
    $('#email').text(data.Email);
    $('#birthday').text(data.Birthday);
    $('#balance').text(data.balance);
    $('.front').attr('src', `./admin/UserIDCard/${data.username}/${data.frontIdCard}`);
    $('.back').attr('src', `./admin/UserIDCard/${data.username}/${data.backIdCard}`);

    if (data.state == 0) {
        $('#state').text('Chưa xác minh');
        $('#icon-state').addClass('fa-triangle-exclamation');
    } else if (data.state == 2) {
        $('#state').text('Tài khoản tạm thời bị khóa');
        $('#icon-state').addClass('fa-clock');
    } else if (data.state == 3) {
        $('#state').text('Tài khoản tạm thời bị khóa');
        $('#icon-state').addClass('fa-lock');
    } else {
        $('#state').text('Đã xác minh');
        $('#icon-state').addClass('fa-circle-check');
    }
}


function get_cookie() {
    const all_cookie = document.cookie;
    const cookies = all_cookie.split(';');
    for (let i = 0; i < cookies.length; i++) {
        if (cookies[i].includes('uid')) {
            return cookies[i].split('=')[1];
        }

    }

    return "";
}


const navClose = document.querySelector(".close-icon"),
    productList = document.querySelectorAll(".product");

for (let i = 0; i <= productList.length; i++) {
    if (productList[i]) {
        productList[i].addEventListener("click", () => {
            document.querySelector(".buy-confirm").classList.add("show-buy");
        });
    }

    if (navClose) {
        navClose.addEventListener("click", () => {
            document.querySelector(".buy-confirm").classList.remove("show-buy");
        });
    }

}

function acceptUser(username) {
    $.ajax({
        url: './admin/admin_function/AcceptUser.php',
        type: 'POST',
        data: {
            username: username
        },
        success: (data) => {
            console.log(data);
            show_toast(data['message'], 1);
        }
    })
}

function declineUser(username) {
    $.ajax({
        url: './admin/admin_function/DeclineUser.php',
        type: 'POST',
        data: {
            username: username
        },
        success: (data) => {
            console.log(data);
            show_toast(data['message'], 1);
        }
    })
}


function additionalDoc(username) {
    $.ajax({
        url: './admin/admin_function/AdditionalDocuments.php',
        type: 'POST',
        data: {
            username: username
        },
        success: (data) => {
            show_toast(data['message'], 1);
        }
    })
}

function lockUser(username) {
    $.ajax({
        url: './admin/admin_function/LockUser.php',
        type: 'POST',
        data: {
            username: username
        },
        success: (data) => {
            show_toast(data['message'], 1);
        }
    })
}

//   menu show
function myFunction() {
    var x = document.querySelector(".box");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}

function transaction_history() {
    $.ajax({
        url: './admin/TransactionHistory.php',
        type: 'post',
        data: {
            username: username
        },
        success: (data) => {
            if (data['code'] == 1) {
                fill_transaction_history(data['message']);
            }
        }
    })
}

function fill_transaction_history(transactions) {
    transactions.forEach(trans => {
        $('.history-list').append(`
            <div class="history-item">
                <div class="history-time">
                    <span>${trans['date']}<time datetime="${trans['date']}"></time></span>
                </div>
                <div class="history-des">
                    <div class="history_content">
                        <p class="transaction_detail"> </p><strong class="transaction_header">Tổng tiền:
                        </strong> ${trans['amount'].toLocaleString('vi-VI', { style: 'currency', currency: 'VND' })}</p>
                    </div>
                    <div class="history_content">
                        <p class="transaction_detail">
                            </><strong class="transaction_header">Trạng thái: </strong> ${convert_type_to_state(trans['state'])}
                        </p>
                    </div>
                    <div class="history_content">
                        <p class="transaction_detail"> </p><strong class="transaction_header">Ghi chú: </strong>
                        ${trans['note']}</p>
                    </div>
                </div>
            </div>
        `)
    });
}

function convert_type_to_state(type) {
    let message = "";
    switch (type) {
        case 0:
            message = "Chờ xác nhận của quản trị viên";
            break;
        case 1:
            message = "Giao dịch thành công";
            break;
        case 2:
            message = "Giao dịch thất bại";
            break;
    }

    return message;
}


document.querySelector(".btn-checked").onclick = () => {
    document.querySelector(".point-3").classList.add("checked")
    document.querySelector(".point-2").classList.remove("checked")
    document.querySelector(".detail-receipt").classList.add("endshow")
    document.querySelector(".check-otp").classList.add("show")
}

document.querySelector(".point-3").onclick = () => {
    document.querySelector(".point-3").classList.add("checked")
    document.querySelector(".point-2").classList.remove("checked")
    document.querySelector(".detail-receipt").classList.add("endshow")
    document.querySelector(".check-otp").classList.add("show")
}


document.querySelector(".btn-back").onclick = () => {
    document.querySelector(".point-3").classList.remove("checked")
    document.querySelector(".point-2").classList.add("checked")
    document.querySelector(".detail-receipt").classList.remove("endshow")
    document.querySelector(".check-otp").classList.remove("show")
}

document.querySelector(".point-2").onclick = () => {
    document.querySelector(".point-3").classList.remove("checked")
    document.querySelector(".point-2").classList.add("checked")
    document.querySelector(".detail-receipt").classList.remove("endshow")
    document.querySelector(".check-otp").classList.remove("show")
}

function inactivateUser(role) {
    $.ajax({
        url: './admin/admin_function/InactivateUser.php',
        type: 'POST',
        data: {
            role: role
        },
        success: (data) => {
            fill_admin_list("#user_inactivate", data);
        }
    })
}

function activatedUser(role) {
    $.ajax({
        url: './admin/admin_function/ActivatedUser.php',
        type: 'POST',
        data: {
            role: role
        },
        success: (data) => {
            fill_admin_list("#user_activated", data);
        }
    })
}



function disabledUser(role) {
    $.ajax({
        url: './admin/admin_function/DisabledUser.php',
        type: 'POST',
        data: {
            role: role
        },
        success: (data) => {
            fill_admin_list('#user_disabled', data);
        }
    })
}


function lockedUser(role) {
    $.ajax({
        url: './admin/admin_function/LockedUser.php',
        type: 'POST',
        data: {
            role: role
        },
        success: (data) => {
            fill_admin_list("#user_locked", data);
        }
    })
}

function fill_admin_list(target, data) {
    console.log(data);
    $(target).empty();
    if (data['status'] == 2) {
        $(target).append(`
            <div class="userList-item">
                <div class="userList-account">
                    <strong>${data['message']}</strong><br>
                </div>
            </div>
        `);
    }
    if (data['status'] == 1) {
        data['message'].forEach(user => {
            $(target).append(`
                <div class="userList-item" id='${user['username']}'>
                    <div class="userList-time">
                    <span>${user['datetime']}<time datetime="2022-02-14 20:00"></time></span>
                    </div>
                    <div class="userList-account">
                        <img src="./images/user1.jpg" style="width:50px; border-radius: 50%;">
                        <span>${user['fullname']}</span><br>
                    </div>
                    <div class="userList-status">
                        <span>${user_state(parseInt(user['state']))}</span>
                    </div>
                </div>
            `)
        })
    }
}


function user_state(state = 0) {
    var message = "";
    switch (state) {
        case 0:
            message = "Mới đăng ký";
            break;
        case 1:
            message = "Đã kích hoạt";
            break;
        case 2:
            message = "Đã vô hiệu hóa";
            break;
        case 3:
            message = "Khóa vô thời hạn";
            break;
        case 4:
            message = "Bổ sung CMND/CCCD";
            break;
    }

    return message;
}

function smooth_clicking() {
    $("a").on('click', function (event) {

        // Make sure this.hash has a value before overriding default behavior
        if (this.hash !== "") {
            // Prevent default anchor click behavior
            event.preventDefault();

            // Store hash
            var hash = this.hash;

            // Using jQuery's animate() method to add smooth page scroll
            // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
            $('html, body').animate({
                scrollTop: $(hash).offset().top
            }, 800, function () {

                // Add hash (#) to URL when done scrolling (default click behavior)
                window.location.hash = hash;
            });
        } // End if
    });
}


function bank_withdraw() {
    $('#withdraw_submit').click(() => {
        const id_card = $('#ccnum').val()
        const cvv = $('#cvv').val()
        const expire_date = $('#expmonth').val()
        const amount = 50000
        const note = $('#note').val()

        const request_json = {
            "username": username,
            "information": {
                "id_card": id_card,
                "cvv": cvv,
                "expire_date": expire_date,
                "amount": amount,
                "note": note
            }
        }

        $.ajax({
            url: './admin/BankWithdrawal.php',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(request_json),
            success: (data) => {
                if (data['code'] == 0) {
                    show_toast(data['message'], 1);
                } else {
                    show_toast(data['message']);
                }
            },
            error: (err) => {
                show_toast(err['message']);
            }
        })
    })
}



function generate_json() {
    const in_username = username;
    const supply = $('input[class=card-select]:checked').val();
    const quantity = $('.count-product').val()
    const denom = $('input[name=current]:checked').val()
    return {
        'username': in_username,
        'cards': [{
            phone_supplier: supply,
            quantity: parseInt(quantity),
            denominations: denom
        }]
    }
}

function buy_card() {
    $('.confirm-btn').click(() => {
        $.ajax({
            url: './admin/BuyPhoneCard.php',
            type: 'post',
            data: JSON.stringify(generate_json()),
            success: (data) => {
                console.log(data);
                if (data['code'] == 0) {
                    show_toast('Mua thành công', 1);
                    window.localStorage.setItem('cards', JSON.stringify({
                        supply: $('input[class=card-select]:checked').val(),
                        denom: $('input[name=current]:checked').val(),
                        quantity: $('.count-product').val(),
                        cards: data['message'],
                    }));
                    window.location.replace('./card_receipt.php');
                } else {
                    show_toast(data['message']);
                }
            },
            error: (err) => {
                console.log(err);
            }
        })
    })
}