const today = new Date();

const resetOnLoad = true;

const formValidation = true;

if (resetOnLoad) {
  window.onload = function () {
    document.getElementById("user_id_header").textContent = "#";
    document.getElementById("user_id").value = "";
    document.getElementById("f_name").value = "";
    document.getElementById("l_name").value = "";
    document.getElementById("birthday").value = today
      .toISOString()
      .substring(0, 10);
    document.getElementById("gender").value = "other";
    document.getElementById("address").value = "";
    document.getElementById("email").value = "";
    document.getElementById("phone").value = "";
  };
}
const validation = () => {
  const fields = [
    // { id: "user_id", type: "text" },
    { id: "f_name", type: "text" },
    { id: "l_name", type: "text" },
    { id: "birthday", type: "text" },
    { id: "gender", type: "select" },
    { id: "address", type: "text" },
    { id: "email", type: "email" },
    { id: "phone", type: "tel" },
  ];

  let isValid = true;

  fields.forEach((field) => {
    const formField = document.getElementById(field.id);

    if (field.type === "email" && !validateEmail(formField.value)) {
      formField.classList.add("is-invalid");
      isValid = false;
    } else if (field.type === "tel" && !validatePhone(formField.value)) {
      formField.classList.add("is-invalid");
      isValid = false;
    } else if (formField.value === "") {
      formField.classList.add("is-invalid");
      isValid = false;
    } else {
      formField.classList.remove("is-invalid");
    }
  });

  return isValid;
};

const resetValidation = () => {
  const fields = [
    "user_id",
    "f_name",
    "l_name",
    "birthday",
    "gender",
    "address",
    "email",
    "phone",
  ];

  fields.forEach((field) => {
    const formField = document.getElementById(field);
    formField.classList.remove("is-invalid");
  });
};

const validateEmail = (email) => {
  const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return regex.test(email);
};

const validatePhone = (phone) => {
  const regex = /^\d+$/;
  return regex.test(phone);
};

const handleEdit = (user) => {
  document.getElementById("user_id_header").textContent = user.user_id;
  document.getElementById("user_id").value = user.user_id;
  document.getElementById("f_name").value = user.f_name;
  document.getElementById("l_name").value = user.l_name;
  document.getElementById("birthday").value = user.b_day;
  document.getElementById("gender").value = user.gender;
  document.getElementById("address").value = user.address;
  document.getElementById("email").value = user.email;
  document.getElementById("phone").value = user.contact_no;

  document.getElementById("addContainer").style.display = "none";
  document.getElementById("updateContainer").style.display = "block";
  document.getElementById("deleteBtn").disabled = false;

  resetValidation();
};

const handleAlert = (type, message) => {
  const alert = document.getElementById("alert");
  alert.classList.add(`alert-${type}`);
  alert.textContent = message;
  alert.style.display = "block";

  setTimeout(() => {
    alert.style.display = "none";
    alert.classList.remove(`alert-${type}`);
  }, 3000);
};

const userForm = document.getElementById("userForm");
userForm.addEventListener("submit", async (event) => {
  event.preventDefault();
  const btn = event.submitter;
  //   console.log(userForm);
  const formData = new FormData(userForm);

  if (btn.id === "addBtn") {
    const isValid = validation();
    // console.log(formData);
    console.log("add is called");
    if (formValidation) {
      if (!isValid) {
        console.log("not valid");
        return;
      }
    }
    try {
      const res = await fetch("../controller/contoller.adduser.php", {
        method: "POST",
        body: formData,
      });

      if (res.ok) {
        const text = await res.text();
        console.log("Response text:", text);
        handleAlert("success", "User added successfully");
      } else {
        console.log(res);
        handleAlert("danger", "User add failed");
      }
    } catch (error) {
      console.log(error);
    }
  } else if (btn.id === "updateBtn") {
    // console.log("updateUser");
    const isValid = validation();
    // console.log(formData);
    if (formValidation) {
      if (!isValid) {
        return;
      }
    }
    try {
      const res = await fetch("../controller/controller.updateuser.php", {
        method: "POST",
        body: formData,
      });
      console.log(res);
      if (res.ok) {
        const text = await res.text();
        console.log("Response text:", text);
        handleAlert("success", "User updated successfully");
      } else {
        console.log(res);
        handleAlert("danger", "User update failed");
      }
    } catch (error) {
      console.log(error);
    }
  } else if (btn.id === "deleteBtn") {
    // console.log("deleteUser");

    try {
      const res = await fetch("../controller/controller.deleteuser.php", {
        method: "POST",
        body: formData,
      });
      console.log(res.ok);
      if (res.ok) {
        const text = await res.text();
        console.log("Response text:", text);
        handleAlert("success", "User deleted successfully");
        clear();
      } else {
        console.log(res);
        handleAlert("danger", "User delete failed");
      }
    } catch (error) {
      console.log(error);
    }

    resetValidation();
  } else if (btn.id === "clearBtn") {
    clear();
    handleAlert("info", "Form cleared");
  }
  displayData(usersData, currentPage);
  displayPagination(usersData);
});

const clear = () => {
  document.getElementById("user_id_header").textContent = "#";
  document.getElementById("user_id").value = "";
  document.getElementById("f_name").value = "";
  document.getElementById("l_name").value = "";
  document.getElementById("birthday").value = today
    .toISOString()
    .substring(0, 10);
  document.getElementById("gender").value = "other";
  document.getElementById("address").value = "";
  document.getElementById("email").value = "";
  document.getElementById("phone").value = "";

  document.getElementById("addContainer").style.display = "block";
  document.getElementById("updateContainer").style.display = "none";
  document.getElementById("deleteBtn").disabled = true;
  resetValidation();
};
