/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**************************************!*\
  !*** ./resources/js/resumeEditor.js ***!
  \**************************************/
var skillList = Array.from(document.querySelectorAll(".skillAndLangForm"));

if (skillList.length != 0 && skillList[0]) {
  skillList.forEach(function (skillItem) {
    return assignSkillButtons(skillItem);
  });
}

var addSkillBtn = document.querySelector(".resume-editor .add-skill button");
if (addSkillBtn) addSkillBtn.addEventListener("click", addSkill);

function addSkill(e) {
  e.preventDefault();
  var newIndex = skillList.length;
  var newElement = document.createElement('div');
  newElement.className = "skillAndLangForm";
  newElement.innerHTML = "\n        <div class=\"input-group \">\n            <label for=\"skill_".concat(newIndex, "\" class=\"sr-only\">Skill <button class=\"skill-up\">\uD83D\uDD3A</button><button class=\"skill-down\">\uD83D\uDD3B</button><button class=\"skill-del\">\uD83D\uDDD1\uFE0F</button></label>\n            <input type=\"text\" name=\"skill_").concat(newIndex, "\" id=\"skill_").concat(newIndex, "\">\n        </div>\n        <div class=\"input-group \">\n            <label for=\"lang_").concat(newIndex, "\" class=\"sr-only\">Languages</label>\n            <input type=\"text\" name=\"lang_").concat(newIndex, "\" id=\"lang_").concat(newIndex, "\">\n        </div>");
  assignSkillButtons(newElement);
  var listParent = document.querySelector('.skillAndLang-container');
  listParent.appendChild(newElement);
  skillList = Array.from(document.querySelectorAll(".skillAndLangForm"));
}

function assignSkillButtons(skillItem) {
  var buttonUp = skillItem.querySelector(".skill-up");
  buttonUp.addEventListener("click", function (e) {
    return moveSkill(e, "up");
  });
  var buttonDown = skillItem.querySelector(".skill-down");
  buttonDown.addEventListener("click", function (e) {
    return moveSkill(e, "down");
  });
  var buttonDel = skillItem.querySelector(".skill-del");
  buttonDel.addEventListener("click", deleteSkill);
}

function moveSkill(e, direction) {
  e.preventDefault();
  var movingItem = e.target.parentNode.parentNode.parentNode;
  var index = parseInt(movingItem.querySelector('input').getAttribute("id").replace("skill_", ""));

  if (direction === "up" && index || direction === "down" && index !== skillList.length - 1) {
    // Modify indexes
    var newIdx = direction === "up" ? index - 1 : index + 1;
    var referenceItem = skillList[newIdx];
    modifySkillIdx(referenceItem, index);
    modifySkillIdx(movingItem, newIdx); //Move items visually

    var listParent = document.querySelector('.skillAndLang-container');

    if (direction === "down" && newIdx === skillList.length - 1) {
      listParent.removeChild(skillList[newIdx]);
      listParent.insertBefore(skillList[newIdx], movingItem);
    } else {
      var refIdx = direction === "up" ? index - 1 : index + 2;
      listParent.removeChild(movingItem);
      listParent.insertBefore(movingItem, skillList[refIdx]);
    }

    skillList = Array.from(document.querySelectorAll(".skillAndLangForm"));
  }
}

function deleteSkill(e) {
  e.preventDefault();
  var deletingItem = e.target.parentNode.parentNode.parentNode;
  var index = parseInt(deletingItem.querySelector('input').getAttribute("id").replace("skill_", "")); // Modify indexes

  var changingItems = skillList.slice(index + 1);
  changingItems.forEach(function (chnItem, itmIdx) {
    return modifySkillIdx(chnItem, itmIdx + index);
  }); // Delete visually

  var listParent = document.querySelector('.skillAndLang-container');
  listParent.removeChild(skillList[index]);
  skillList = Array.from(document.querySelectorAll(".skillAndLangForm"));
}

function modifySkillIdx(targetItem, newIndex) {
  Array.from(targetItem.querySelectorAll('.input-group')).forEach(function (inputGroup, groupIdx) {
    var newAttr = groupIdx ? "lang_".concat(newIndex) : "skill_".concat(newIndex);
    inputGroup.querySelector('label').setAttribute("for", newAttr);
    inputGroup.querySelector('input').setAttribute("name", newAttr);
    inputGroup.querySelector('input').setAttribute("id", newAttr);
  });
} //////////////////////////////////


var workList = Array.from(document.querySelectorAll(".work-form"));

if (workList.length != 0 && workList[0]) {
  workList.forEach(function (workItem) {
    return assignWorkButtons(workItem);
  });
}

var addWorkBtn = document.querySelector(".resume-editor .add-work button");
if (addWorkBtn) addWorkBtn.addEventListener("click", addWork);

function addWork(e) {
  e.preventDefault();
  var newIndex = workList.length;
  var newElement = document.createElement('div');
  newElement.className = "work-form";
  newElement.innerHTML = "\n        <div class=\"input-group \">\n            <label for=\"workName_".concat(newIndex, "\" class=\"sr-only\">Name <button class=\"work-up\">\uD83D\uDD3A</button><button class=\"work-down\">\uD83D\uDD3B</button><button class=\"work-del\">\uD83D\uDDD1\uFE0F</button></label>\n            <input type=\"text\" name=\"workName_").concat(newIndex, "\" id=\"workName_").concat(newIndex, "\">\n        </div>\n        <div class=\"input-group \">\n            <label for=\"workPos_").concat(newIndex, "\" class=\"sr-only\">Position</label>\n            <input type=\"text\" name=\"workPos_").concat(newIndex, "\" id=\"workPos_").concat(newIndex, "\">\n        </div>\n        <div class=\"input-group \">\n            <label for=\"workLoc_").concat(newIndex, "\" class=\"sr-only\">Location</label>\n            <input type=\"text\" name=\"workLoc_").concat(newIndex, "\" id=\"workLoc_").concat(newIndex, "\">\n        </div>\n        <div class=\"input-group \">\n            <label for=\"workStrtDate_").concat(newIndex, "\" class=\"sr-only\">Start date</label>\n            <input type=\"date\" name=\"workStrtDate_").concat(newIndex, "\" id=\"workStrtDate_").concat(newIndex, "\">\n        </div>\n        <div class=\"input-group \">\n            <label for=\"workEndDate_").concat(newIndex, "\" class=\"sr-only\">End date</label>\n            <input type=\"date\" name=\"workEndDate_").concat(newIndex, "\" id=\"workEndDate_").concat(newIndex, "\">\n        </div>\n        <div class=\"input-group \">\n            <label for=\"workSumm_").concat(newIndex, "\" class=\"sr-only\">Summary</label>\n            <input type=\"text\" name=\"workSumm_").concat(newIndex, "\" id=\"workSumm_").concat(newIndex, "\">\n        </div>\n        <div class=\"input-group \">\n            <label for=\"workUrl_").concat(newIndex, "\" class=\"sr-only\">URL</label>\n            <input type=\"url\" name=\"workUrl_").concat(newIndex, "\" id=\"workUrl_").concat(newIndex, "\">\n        </div>\n        <div class=\"input-group \">\n            <label for=\"workHi_").concat(newIndex, "\" class=\"sr-only\">Highlights</label>\n            <textarea name=\"workHi_").concat(newIndex, "\" id=\"workHi_").concat(newIndex, "\" cols=\"30\" rows=\"4\" placeholder=\"Tell something great...\"></textarea>\n        </div>\n        <button class=\"work-add-timg\">\uD83D\uDDBC\uFE0F Add a thumbnail (optional)</button>");
  assignWorkButtons(newElement);
  var listParent = document.querySelector('.work-form-container');
  listParent.appendChild(newElement);
  workList = Array.from(document.querySelectorAll(".work-form"));
}

function assignWorkButtons(workItem) {
  var buttonUp = workItem.querySelector(".work-up");
  buttonUp.addEventListener("click", function (e) {
    return moveWork(e, "up");
  });
  var buttonDown = workItem.querySelector(".work-down");
  buttonDown.addEventListener("click", function (e) {
    return moveWork(e, "down");
  });
  var buttonDel = workItem.querySelector(".work-del");
  buttonDel.addEventListener("click", deleteWork);
  var buttonAddTimg = workItem.querySelector(".work-add-timg");

  if (buttonAddTimg) {
    buttonAddTimg.addEventListener("click", addWorkTimgField);
  }
}

function moveWork(e, direction) {
  e.preventDefault();
  var movingItem = e.target.parentNode.parentNode.parentNode;
  var index = parseInt(movingItem.querySelector('input').getAttribute("id").replace("workName_", ""));

  if (direction === "up" && index || direction === "down" && index !== workList.length - 1) {
    // Modify indexes
    var newIdx = direction === "up" ? index - 1 : index + 1;
    var referenceItem = workList[newIdx];
    modifyWorkIdx(referenceItem, index);
    modifyWorkIdx(movingItem, newIdx); //Move items visually

    var listParent = document.querySelector('.work-form-container');

    if (direction === "down" && newIdx === workList.length - 1) {
      listParent.removeChild(workList[newIdx]);
      listParent.insertBefore(workList[newIdx], movingItem);
    } else {
      var refIdx = direction === "up" ? index - 1 : index + 2;
      listParent.removeChild(movingItem);
      listParent.insertBefore(movingItem, workList[refIdx]);
    }

    workList = Array.from(document.querySelectorAll(".work-form"));
  }
}

function deleteWork(e) {
  e.preventDefault();
  var deletingItem = e.target.parentNode.parentNode.parentNode;
  var index = parseInt(deletingItem.querySelector('input').getAttribute("id").replace("workName_", "")); // Modify indexes

  var changingItems = workList.slice(index + 1);
  changingItems.forEach(function (chnItem, itmIdx) {
    return modifyWorkIdx(chnItem, itmIdx + index);
  }); // Delete visually

  var listParent = document.querySelector('.work-form-container');
  listParent.removeChild(workList[index]);
  workList = Array.from(document.querySelectorAll(".work-form"));
}

var WORK_TEXTAREA_INDEX = 7;

function modifyWorkIdx(targetItem, newIndex) {
  Array.from(targetItem.querySelectorAll('.input-group')).forEach(function (inputGroup, groupIdx) {
    var oldAttrArr = inputGroup.querySelector('label').getAttribute("for").split("_");
    var newAttr = oldAttrArr[0] + "_" + newIndex;
    inputGroup.querySelector('label').setAttribute("for", newAttr);

    if (groupIdx === WORK_TEXTAREA_INDEX) {
      inputGroup.querySelector('textarea').setAttribute("name", newAttr);
      inputGroup.querySelector('textarea').setAttribute("id", newAttr);
    } else {
      inputGroup.querySelector('input').setAttribute("name", newAttr);
      inputGroup.querySelector('input').setAttribute("id", newAttr);
    }
  });
}

function addWorkTimgField(e) {
  e.preventDefault();
  var workItem = e.target.parentNode.parentNode;
  var index = parseInt(workItem.querySelector('input').getAttribute("id").replace("workName_", "")); // Create thumbnail preview area

  var timgView = document.createElement("div");
  timgView.className = "timg-preview";
  timgView.innerHTML = "\n        <img>"; // Create thumbnail image input

  var timgField = document.createElement("div");
  timgField.className = "input-group";
  timgField.innerHTML = "\n        <label for=\"workTimg_".concat(index, "\" class=\"sr-only\">Thumbnail (optional)</label>\n        <input type=\"file\" accept=\"image/png, image/jpeg\" name=\"workTimg_").concat(index, "\" id=\"workTimg_").concat(index, "\">");
  timgField.querySelector("input").addEventListener("input", function (e) {
    return previewTimg(e, index, "work");
  });
  var workTimgField = workItem.querySelector(".work-timg-field");
  e.target.removeEventListener("click", addWorkTimgField);
  workTimgField.removeChild(e.target);

  if (!workTimgField.querySelector(".timg-preview")) {
    workTimgField.appendChild(timgView);
  }

  workTimgField.appendChild(timgField);
}

function previewTimg(e, index, type) {
  var file = e.target.files[0];

  if (file.type && !file.type.startsWith('image/')) {
    console.log('File is not an image.', file.type, file);
    return;
  }

  var timgPreview = e.target.parentNode.parentNode.querySelector(".timg-preview");
  var img = timgPreview.querySelector("img");
  var reader = new FileReader();
  reader.addEventListener('load', function (event) {
    img.src = event.target.result;
    var oldTimg = document.getElementById("".concat(type, "OlTimg_").concat(index));

    if (oldTimg) {
      timgPreview.parentNode.removeChild(oldTimg);
    }
  });
  reader.readAsDataURL(file);
} ////////////////////////////////////////


var projList = Array.from(document.querySelectorAll(".proj-form"));

if (projList.length != 0 && projList[0]) {
  projList.forEach(function (projItem) {
    return assignProjButtons(projItem);
  });
}

var addProjBtn = document.querySelector(".resume-editor .add-project button");
if (addProjBtn) addProjBtn.addEventListener("click", addProj);

function addProj(e) {
  e.preventDefault();
  var newIndex = projList.length;
  var newElement = document.createElement('div');
  newElement.className = "proj-form";
  newElement.innerHTML = "\n        <div class=\"input-group \">\n            <label for=\"projName_".concat(newIndex, "\" class=\"sr-only\">Name <button class=\"proj-up\">\uD83D\uDD3A</button><button class=\"proj-down\">\uD83D\uDD3B</button><button class=\"proj-del\">\uD83D\uDDD1\uFE0F</button></label>\n            <input type=\"text\" name=\"projName_").concat(newIndex, "\" id=\"projName_").concat(newIndex, "\">\n        </div>\n        <div class=\"input-group \">\n            <label for=\"projEnt_").concat(newIndex, "\" class=\"sr-only\">Entity</label>\n            <input type=\"text\" name=\"projEnt_").concat(newIndex, "\" id=\"projEnt_").concat(newIndex, "\">\n        </div>\n        <div class=\"input-group \">\n            <label for=\"projType_").concat(newIndex, "\" class=\"sr-only\">Type</label>\n            <input type=\"text\" name=\"projType_").concat(newIndex, "\" id=\"projType_").concat(newIndex, "\">\n        </div>\n        <div class=\"input-group \">\n            <label for=\"projStrtDate_").concat(newIndex, "\" class=\"sr-only\">Start date</label>\n            <input type=\"date\" name=\"projStrtDate_").concat(newIndex, "\" id=\"projStrtDate_").concat(newIndex, "\">\n        </div>\n        <div class=\"input-group \">\n            <label for=\"projEndDate_").concat(newIndex, "\" class=\"sr-only\">End date</label>\n            <input type=\"date\" name=\"projEndDate_").concat(newIndex, "\" id=\"projEndDate_").concat(newIndex, "\">\n        </div>\n        <div class=\"input-group \">\n            <label for=\"projRoles_").concat(newIndex, "\" class=\"sr-only\">Roles</label>\n            <input type=\"text\" name=\"projRoles_").concat(newIndex, "\" id=\"projRoles_").concat(newIndex, "\">\n        </div>\n        <div class=\"input-group \">\n            <label for=\"projDesc_").concat(newIndex, "\" class=\"sr-only\">Description</label>\n            <input type=\"text\" name=\"projDesc_").concat(newIndex, "\" id=\"projDesc_").concat(newIndex, "\">\n        </div>\n        <div class=\"input-group \">\n            <label for=\"projHi_").concat(newIndex, "\" class=\"sr-only\">Highlights</label>\n            <textarea name=\"projHi_").concat(newIndex, "\" id=\"projHi_").concat(newIndex, "\" cols=\"30\" rows=\"4\" placeholder=\"Tell something great...\"></textarea>\n        </div>\n        <div class=\"input-group \">\n            <label for=projUrl_").concat(newIndex, "\" class=\"sr-only\">URL</label>\n            <input type=\"url\" name=\"projUrl_").concat(newIndex, "\" id=\"projUrl_").concat(newIndex, "\">\n        </div>\n        <div class=\"input-group \">\n            <label for=\"projKeys_").concat(newIndex, "\" class=\"sr-only\">Keys</label>\n            <input type=\"text\" name=\"projKeys_").concat(newIndex, "\" id=\"projKeys_").concat(newIndex, "\">\n        </div>\n        <button class=\"proj-add-timg\">\uD83D\uDDBC\uFE0F Add a thumbnail (optional)</button>");
  assignProjButtons(newElement);
  var listParent = document.querySelector('.proj-form-container');
  listParent.appendChild(newElement);
  projList = Array.from(document.querySelectorAll(".proj-form"));
}

function assignProjButtons(projItem) {
  var buttonUp = projItem.querySelector(".proj-up");
  buttonUp.addEventListener("click", function (e) {
    return moveProj(e, "up");
  });
  var buttonDown = projItem.querySelector(".proj-down");
  buttonDown.addEventListener("click", function (e) {
    return moveProj(e, "down");
  });
  var buttonDel = projItem.querySelector(".proj-del");
  buttonDel.addEventListener("click", deleteProj);
  var buttonAddTimg = projItem.querySelector(".proj-add-timg");

  if (buttonAddTimg) {
    buttonAddTimg.addEventListener("click", addProjTimgField);
  }
}

function moveProj(e, direction) {
  e.preventDefault();
  var movingItem = e.target.parentNode.parentNode.parentNode;
  var index = parseInt(movingItem.querySelector('input').getAttribute("id").replace("projName_", ""));

  if (direction === "up" && index || direction === "down" && index !== projList.length - 1) {
    // Modify indexes
    var newIdx = direction === "up" ? index - 1 : index + 1;
    var referenceItem = projList[newIdx];
    modifyProjIdx(referenceItem, index);
    modifyProjIdx(movingItem, newIdx); //Move items visually

    var listParent = document.querySelector('.proj-form-container');

    if (direction === "down" && newIdx === projList.length - 1) {
      listParent.removeChild(projList[newIdx]);
      listParent.insertBefore(projList[newIdx], movingItem);
    } else {
      var refIdx = direction === "up" ? index - 1 : index + 2;
      listParent.removeChild(movingItem);
      listParent.insertBefore(movingItem, projList[refIdx]);
    }

    projList = Array.from(document.querySelectorAll(".proj-form"));
  }
}

function deleteProj(e) {
  e.preventDefault();
  var deletingItem = e.target.parentNode.parentNode.parentNode;
  var index = parseInt(deletingItem.querySelector('input').getAttribute("id").replace("projName_", "")); // Modify indexes

  var changingItems = projList.slice(index + 1);
  changingItems.forEach(function (chnItem, itmIdx) {
    return modifyProjIdx(chnItem, itmIdx + index);
  }); // Delete visually

  var listParent = document.querySelector('.proj-form-container');
  listParent.removeChild(projList[index]);
  projList = Array.from(document.querySelectorAll(".proj-form"));
}

var PROJ_TEXTAREA_INDEX = 8;

function modifyProjIdx(targetItem, newIndex) {
  Array.from(targetItem.querySelectorAll('.input-group')).forEach(function (inputGroup, groupIdx) {
    var oldAttrArr = inputGroup.querySelector('label').getAttribute("for").split("_");
    var newAttr = oldAttrArr[0] + "_" + newIndex;
    inputGroup.querySelector('label').setAttribute("for", newAttr);

    if (groupIdx === PROJ_TEXTAREA_INDEX) {
      inputGroup.querySelector('textarea').setAttribute("name", newAttr);
      inputGroup.querySelector('textarea').setAttribute("id", newAttr);
    } else {
      inputGroup.querySelector('input').setAttribute("name", newAttr);
      inputGroup.querySelector('input').setAttribute("id", newAttr);
    }
  });
}

function addProjTimgField(e) {
  e.preventDefault();
  var projItem = e.target.parentNode.parentNode;
  var index = parseInt(projItem.querySelector('input').getAttribute("id").replace("projName_", "")); // Create thumbnail preview area

  var timgView = document.createElement("div");
  timgView.className = "timg-preview";
  timgView.innerHTML = "\n        <img>"; // Create thumbnail image input

  var timgField = document.createElement("div");
  timgField.className = "input-group";
  timgField.innerHTML = "\n        <label for=\"projTimg_".concat(index, "\" class=\"sr-only\">Thumbnail (optional)</label>\n        <input type=\"file\" accept=\"image/png, image/jpeg\" name=\"projTimg_").concat(index, "\" id=\"projTimg_").concat(index, "\">");
  timgField.querySelector("input").addEventListener("input", function (e) {
    return previewTimg(e, index, "proj");
  });
  var projTimgField = projItem.querySelector(".proj-timg-field");
  e.target.removeEventListener("click", addProjTimgField);
  projTimgField.removeChild(e.target);

  if (!projTimgField.querySelector(".timg-preview")) {
    projTimgField.appendChild(timgView);
  }

  projTimgField.appendChild(timgField);
}
/******/ })()
;