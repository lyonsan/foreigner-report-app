/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************!*\
  !*** ./resources/js/showForm.js ***!
  \**********************************/
var userRoleElement = document.getElementById('user_role');
var userSchoolWrapper = document.getElementById('user_school_wrapper');
var userEduOrgWrapper = document.getElementById('user_edu_org_wrapper');

function changeUserRole() {
  if (userRoleElement.value == 'child') {
    userSchoolWrapper.classList.remove('d-none');
    userEduOrgWrapper.classList.add('d-none');
  } else if (userRoleElement.value == 'teacher') {
    userSchoolWrapper.classList.add('d-none');
    userEduOrgWrapper.classList.remove('d-none');
  } else {
    userSchoolWrapper.classList.add('d-none');
    userEduOrgWrapper.classList.add('d-none');
  }
}

document.getElementById('user_role').onchange = changeUserRole;
/******/ })()
;