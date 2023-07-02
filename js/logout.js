//Membuat Fungsi Logout
function logout() {
  var confirmation = confirm("Apakah Anda yakin ingin keluar?");
  if (confirmation) {
    window.location.href = "index.php";
  }
}
