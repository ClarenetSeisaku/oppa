/* 住所自動反映 */

document.addEventListener("DOMContentLoaded", function () {
  const zip = document.getElementById("member_zip");

  if (zip) {
    zip.addEventListener("keyup", function () {
      AjaxZip3.zip2addr("member_zip", "", "member_address", "member_address");
    });
    zip.addEventListener("change", function () {
      AjaxZip3.zip2addr("member_zip", "", "member_address", "member_address");
    });
    zip.addEventListener("blur", function () {
      AjaxZip3.zip2addr("member_zip", "", "member_address", "member_address");
    });
  }
});
