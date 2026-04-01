import './bootstrap';

document.addEventListener("DOMContentLoaded", function () {

    const roleSelectUser   = document.getElementById("roleSelectUser");
    const classWrapper     = document.getElementById("classSelectWrapper");
    const companyWrapper   = document.getElementById("companySelectWrapper");

    function updateUserFields() {
        const role = roleSelectUser.value;

        classWrapper.classList.add("hidden");
        companyWrapper.classList.add("hidden");

        if (role == "{{ App\Models\User::ROLE_STUDENT }}") {
            classWrapper.classList.remove("hidden");
        }

        if (role == "{{ App\Models\User::ROLE_SUPERVISOR }}") {
            companyWrapper.classList.remove("hidden");
        }
    }

    roleSelectUser.addEventListener("change", updateUserFields);

    const roleSelect       = document.getElementById("roleSelect");
    const studentWrapper   = document.getElementById("studentWrapper");
    const supervisorWrapper = document.getElementById("supervisorWrapper");

    function updateAssignFields() {
        const role = roleSelect.value;

        studentWrapper.classList.add("hidden");
        supervisorWrapper.classList.add("hidden");

        if (role === "student")    studentWrapper.classList.remove("hidden");
        if (role === "supervisor") supervisorWrapper.classList.remove("hidden");
    }

    roleSelect.addEventListener("change", updateAssignFields);
});

document.addEventListener('click', function(e) {
    const dropdown = document.getElementById('userDropdown');
    const button = dropdown.previousElementSibling;

    if (!button.contains(e.target) && !dropdown.contains(e.target)) {
        dropdown.classList.add('hidden');
    }
});
