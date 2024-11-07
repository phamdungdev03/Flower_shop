document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const fullname = document.getElementById('fullname');
    const username = document.getElementById('username');
    const email = document.getElementById('email');
    const address = document.getElementById('address');
    const phone = document.getElementById('phone');
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirm_password');

    form.addEventListener('submit', function(event) {
        if (!fullname.value.trim() || !username.value.trim() || !email.value.trim() ||
            !address.value.trim() || !phone.value.trim() || !password.value.trim() ||
            !confirmPassword.value.trim()) {
            alert("Vui lòng điền đầy đủ thông tin.");
            event.preventDefault();
            return;
        }

        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email.value)) {
            alert("Email không hợp lệ.");
            event.preventDefault();
            return;
        }

        if (!/^\d{10}$/.test(phone.value)) {
            alert("Số điện thoại phải là 10 chữ số.");
            event.preventDefault();
            return;
        }

        if (password.value.length < 8) {
            alert("Mật khẩu phải có ít nhất 8 ký tự.");
            event.preventDefault();
            return;
        }

        if (password.value !== confirmPassword.value) {
            alert("Mật khẩu và nhập lại mật khẩu không khớp.");
            event.preventDefault();
            return;
        }
    });
});