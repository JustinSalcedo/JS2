let skillList = Array.from(document.querySelectorAll(".skillAndLangForm"))

if (skillList.length != 0 && skillList[0]) {
    skillList.forEach(skillItem => assignSkillButtons(skillItem))
}

const addSkillBtn = document.querySelector(".resume-editor .add-skill button")
if (addSkillBtn) addSkillBtn.addEventListener("click", addSkill)

function addSkill(e) {
    e.preventDefault()

    const newIndex = skillList.length
    const newElement = document.createElement('div')
    newElement.className = "skillAndLangForm"
    newElement.innerHTML = `
        <div class="input-group ">
            <label for="skill_${newIndex}" class="sr-only">Skill <button class="skill-up">🔺</button><button class="skill-down">🔻</button><button class="skill-del">🗑️</button></label>
            <input type="text" name="skill_${newIndex}" id="skill_${newIndex}">
        </div>
        <div class="input-group ">
            <label for="lang_${newIndex}" class="sr-only">Languages</label>
            <input type="text" name="lang_${newIndex}" id="lang_${newIndex}">
        </div>`

    assignSkillButtons(newElement)

    const listParent = document.querySelector('.skillAndLang-container')
    listParent.appendChild(newElement)

    skillList = Array.from(document.querySelectorAll(".skillAndLangForm"))
}

function assignSkillButtons(skillItem) {
    const buttonUp = skillItem.querySelector(".skill-up")
    buttonUp.addEventListener("click", e => moveSkill(e, "up"))

    const buttonDown = skillItem.querySelector(".skill-down")
    buttonDown.addEventListener("click", e => moveSkill(e, "down"))

    const buttonDel = skillItem.querySelector(".skill-del")
    buttonDel.addEventListener("click", deleteSkill)
}

function moveSkill(e, direction) {
    e.preventDefault()

    const movingItem = e.target.parentNode.parentNode.parentNode
    const index = parseInt(movingItem.querySelector('input').getAttribute("id").replace("skill_", ""))
    if ((direction === "up" && index) || (direction === "down" && index !== skillList.length - 1)) {
        // Modify indexes
        const newIdx = (direction === "up") ? index - 1 : index + 1
        const referenceItem = skillList[newIdx]
        modifySkillIdx(referenceItem, index)
        modifySkillIdx(movingItem, newIdx)

        //Move items visually
        const listParent = document.querySelector('.skillAndLang-container')
        if ((direction === "down") && (newIdx === skillList.length - 1)) {
            listParent.removeChild(skillList[newIdx])
            listParent.insertBefore(skillList[newIdx], movingItem)
        } else {
            const refIdx = (direction === "up") ? index - 1 : index + 2
            listParent.removeChild(movingItem)
            listParent.insertBefore(movingItem, skillList[refIdx])
        }

        skillList = Array.from(document.querySelectorAll(".skillAndLangForm"))
    }
}

function deleteSkill(e) {
    e.preventDefault()
    const deletingItem = e.target.parentNode.parentNode.parentNode
    const index = parseInt(deletingItem.querySelector('input').getAttribute("id").replace("skill_", ""))

    // Modify indexes
    const changingItems = skillList.slice(index + 1)
    changingItems.forEach((chnItem, itmIdx) => modifySkillIdx(chnItem, itmIdx + index))

    // Delete visually
    const listParent = document.querySelector('.skillAndLang-container')
    listParent.removeChild(skillList[index])

    skillList = Array.from(document.querySelectorAll(".skillAndLangForm"))
}

function modifySkillIdx(targetItem, newIndex) {
    Array.from(targetItem.querySelectorAll('.input-group')).forEach((inputGroup, groupIdx) => {
        const newAttr = groupIdx ? `lang_${newIndex}` : `skill_${newIndex}`

        inputGroup.querySelector('label').setAttribute("for", newAttr)
        inputGroup.querySelector('input').setAttribute("name", newAttr)
        inputGroup.querySelector('input').setAttribute("id", newAttr)
    })
}


//////////////////////////////////


let workList = Array.from(document.querySelectorAll(".work-form"))

if (workList.length != 0 && workList[0]) {
    workList.forEach(workItem => assignWorkButtons(workItem))
}

const addWorkBtn = document.querySelector(".resume-editor .add-work button")
if (addWorkBtn) addWorkBtn.addEventListener("click", addWork)

function addWork(e) {
    e.preventDefault()

    const newIndex = workList.length
    const newElement = document.createElement('div')
    newElement.className = "work-form"
    newElement.innerHTML = `
        <div class="input-group ">
            <label for="workName_${newIndex}" class="sr-only">Name <button class="work-up">🔺</button><button class="work-down">🔻</button><button class="work-del">🗑️</button></label>
            <input type="text" name="workName_${newIndex}" id="workName_${newIndex}">
        </div>
        <div class="input-group ">
            <label for="workPos_${newIndex}" class="sr-only">Position</label>
            <input type="text" name="workPos_${newIndex}" id="workPos_${newIndex}">
        </div>
        <div class="input-group ">
            <label for="workLoc_${newIndex}" class="sr-only">Location</label>
            <input type="text" name="workLoc_${newIndex}" id="workLoc_${newIndex}">
        </div>
        <div class="input-group ">
            <label for="workStrtDate_${newIndex}" class="sr-only">Start date</label>
            <input type="date" name="workStrtDate_${newIndex}" id="workStrtDate_${newIndex}">
        </div>
        <div class="input-group ">
            <label for="workEndDate_${newIndex}" class="sr-only">End date</label>
            <input type="date" name="workEndDate_${newIndex}" id="workEndDate_${newIndex}">
        </div>
        <div class="input-group ">
            <label for="workHi_${newIndex}" class="sr-only">Highlights</label>
            <textarea name="workHi_${newIndex}" id="workHi_${newIndex}" cols="30" rows="4" placeholder="Tell something great..."></textarea>
        </div>`

    assignWorkButtons(newElement)

    const listParent = document.querySelector('.work-form-container')
    listParent.appendChild(newElement)

    workList = Array.from(document.querySelectorAll(".work-form"))
}

function assignWorkButtons(workItem) {
    const buttonUp = workItem.querySelector(".work-up")
    buttonUp.addEventListener("click", e => moveWork(e, "up"))

    const buttonDown = workItem.querySelector(".work-down")
    buttonDown.addEventListener("click", e => moveWork(e, "down"))

    const buttonDel = workItem.querySelector(".work-del")
    buttonDel.addEventListener("click", deleteWork)
}

function moveWork(e, direction) {
    e.preventDefault()

    const movingItem = e.target.parentNode.parentNode.parentNode
    const index = parseInt(movingItem.querySelector('input').getAttribute("id").replace("workName_", ""))
    if ((direction === "up" && index) || (direction === "down" && index !== workList.length - 1)) {
        // Modify indexes
        const newIdx = (direction === "up") ? index - 1 : index + 1
        const referenceItem = workList[newIdx]
        modifyWorkIdx(referenceItem, index)
        modifyWorkIdx(movingItem, newIdx)

        //Move items visually
        const listParent = document.querySelector('.work-form-container')
        if ((direction === "down") && (newIdx === workList.length - 1)) {
            listParent.removeChild(workList[newIdx])
            listParent.insertBefore(workList[newIdx], movingItem)
        } else {
            const refIdx = (direction === "up") ? index - 1 : index + 2
            listParent.removeChild(movingItem)
            listParent.insertBefore(movingItem, workList[refIdx])
        }

        workList = Array.from(document.querySelectorAll(".work-form"))
    }
}

function deleteWork(e) {
    e.preventDefault()
    const deletingItem = e.target.parentNode.parentNode.parentNode
    const index = parseInt(deletingItem.querySelector('input').getAttribute("id").replace("workName_", ""))

    // Modify indexes
    const changingItems = workList.slice(index + 1)
    changingItems.forEach((chnItem, itmIdx) => modifyWorkIdx(chnItem, itmIdx + index))

    // Delete visually
    const listParent = document.querySelector('.work-form-container')
    listParent.removeChild(workList[index])

    workList = Array.from(document.querySelectorAll(".work-form"))
}

const WORK_TEXTAREA_INDEX = 5

function modifyWorkIdx(targetItem, newIndex) {
    Array.from(targetItem.querySelectorAll('.input-group')).forEach((inputGroup, groupIdx) => {
        const oldAttrArr = inputGroup.querySelector('label').getAttribute("for").split("_")
        const newAttr = oldAttrArr[0] + "_" + newIndex

        inputGroup.querySelector('label').setAttribute("for", newAttr)
        if (groupIdx === WORK_TEXTAREA_INDEX) {
            inputGroup.querySelector('textarea').setAttribute("name", newAttr)
            inputGroup.querySelector('textarea').setAttribute("id", newAttr)
        } else {
            inputGroup.querySelector('input').setAttribute("name", newAttr)
            inputGroup.querySelector('input').setAttribute("id", newAttr)
        }
    })
}

