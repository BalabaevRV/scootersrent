const $btnListScooter = document.querySelector("#btnListScooter");
const $selectUser = document.querySelector("#user_id");
const $inputName = document.querySelector("#name_input");
const $inputEmail = document.querySelector("#email_input");
const $infoChange = document.querySelector("#infoChange");
let currentEmail;

if ($btnListScooter) {
    $btnListScooter.addEventListener("click", btnListScooterClick);
}

if ($inputEmail && $inputName && $infoChange) {
    $inputEmail.addEventListener("change", toggleInfoChange);
    currentEmail = $inputEmail.value;
    if ($selectUser) {
        $selectUser.addEventListener("change", selectUserChange);
    }
}

function btnListScooterClick () {
   const $ulListScooter = document.querySelector("#ulListScooter");
   if ($ulListScooter) {
       if ($ulListScooter.style.display === "none") {
           $ulListScooter.style.display = "block";
       } else {
           $ulListScooter.style.display = "none";
       }
   }
}

function selectUserChange () {
    $inputName.value = $selectUser.selectedOptions[0].getAttribute("data-bs-name");
    $inputEmail.value = $selectUser.selectedOptions[0].getAttribute("data-bs-email");
    $infoChange.value = "";
}

function toggleInfoChange () {
    console.log(this);
    if ($inputEmail.value === currentEmail) {
        $infoChange.value = "";
    } else {
        $infoChange.value = "1";
    }
}
