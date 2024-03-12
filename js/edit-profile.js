function edit()
{
    document.getElementById("edit").setAttribute("hidden", true);
    document.getElementById("fname").removeAttribute("disabled");
    document.getElementById("mname").removeAttribute("disabled");
    document.getElementById("lname").removeAttribute("disabled");
    document.getElementById("bday").removeAttribute("disabled");
    document.getElementById("gender").removeAttribute("disabled");
    document.getElementById("cpnum").removeAttribute("disabled");
    document.getElementById("barangay").removeAttribute("disabled");
    document.getElementById("municipality").removeAttribute("disabled");
    document.getElementById("province").removeAttribute("disabled");
    document.getElementById("email").removeAttribute("disabled");
    document.getElementById("uname").removeAttribute("disabled");
    document.getElementById("pws").removeAttribute("disabled");
    document.getElementById("cancel").removeAttribute("hidden");
    document.getElementById("save").removeAttribute("hidden");
    document.getElementById("wizard_picture").removeAttribute("hidden");
    document.getElementById("name").setAttribute("hidden", true);
    document.getElementById("mail").setAttribute("hidden", true);
    document.getElementById("add").setAttribute("hidden", true);



}
let cancel = document.getElementById("cancel");
cancel.addEventListener("click",
function cancel()
{
    document.getElementById("edit").removeAttribute("hidden");
    document.getElementById("fname").setAttribute("disabled", true);
    document.getElementById("mname").setAttribute("disabled", true);
    document.getElementById("lname").setAttribute("disabled", true);
    document.getElementById("bday").setAttribute("disabled", true);
    document.getElementById("gender").setAttribute("disabled", true);
    document.getElementById("cpnum").setAttribute("disabled", true);
    document.getElementById("barangay").setAttribute("disabled", true);
    document.getElementById("municipality").setAttribute("disabled", true);
    document.getElementById("province").setAttribute("disabled", true);
    document.getElementById("email").setAttribute("disabled", true);
    document.getElementById("uname").setAttribute("disabled", true);
    document.getElementById("pws").setAttribute("disabled", true);
    document.getElementById("cancel").setAttribute("hidden", true);
    document.getElementById("save").setAttribute("hidden", true);
    document.getElementById("wizard_picture").setAttribute("hidden", true);
    document.getElementById("form").reset();
})