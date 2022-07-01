require('./resumeEditor')

const NAV_BAR_HEIGHT = 88

const heading1 = document.querySelector('h1')
heading1.addEventListener("click", scrollToTop)

const burgerBtn = document.querySelector('button.nav-burger')
burgerBtn.addEventListener("click", toggleSideNavbar)

const homeBtn = document.getElementById('go-hide')
homeBtn.addEventListener("click", goHide)

const blackout = document.querySelector('.blackout')
let isModalOn = false
let activeModal = null
blackout.addEventListener("click", () => {
    if (!isModalOn) {
        toggleSideNavbar()
    } else {
        closeModal()
    }
})

const sideNavbar = document.querySelector('nav.nav-content')

// addEventListener("scroll", () => console.log('scrolling'))

function goHide() {
    // scrollToTop()
    toggleSideNavbar()
}

function scrollToTop() {
    window.scroll(0, 0)
}

function toggleSideNavbar() {
    const { display } = sideNavbar.style

    if (!display || display === "none") {
        sideNavbar.style.display = "initial"
        deactivateScrolling()
        blackout.classList.replace('off', 'on')
        enableTabletSide()
    }

    if (display === "initial") {
        sideNavbar.style.display = "none"
        activateScrolling()
        blackout.classList.replace('on', 'off')
        disableTableSide()
    }
}

function closeModal() {
    if (blackout.className === "blackout on modal") {
        activateScrolling()
        blackout.classList.replace('on', 'off')
        blackout.classList.remove('modal')
        activeModal.classList.remove('on')
        activeModal.parentNode.removeAttribute("open")
        activeModal = null
        isModalOn = false
    }
}

function deactivateScrolling() {
    if (window.innerWidth < 561 || isModalOn) {
        document.body.style.height = "100%"
        document.body.style.overflow = "hidden"
    }
}

function activateScrolling() {
    document.body.style = {}
}

function enableTabletSide() {
    if (window.innerWidth > 767) {
        document.body.classList.add("double-view")

    }
}

function disableTableSide() {
    document.body.classList.remove("double-view")
}

const themeBtns = document.querySelectorAll('.switch-theme')
Array.from(themeBtns).forEach(themeBtn => {
    themeBtn.addEventListener("click", switchDarkTheme)
})

function switchDarkTheme() {
    const { classList } = document.body

    if (!classList.contains("dark-theme")) {
        document.body.classList.add("dark-theme")
        addWhiteIcons()
        Array.from(themeBtns).forEach(themeBtn => {
            themeBtn.innerHTML = "☀️"
        })
    } else {
        document.body.classList.remove("dark-theme")
        addInitialIcons()
        Array.from(themeBtns).forEach(themeBtn => {
            themeBtn.innerHTML = "🌙"
        })
    }
}

function addWhiteIcons() {
    const iconsList = document.querySelectorAll('.nav-footer .social-links img, .contact-info.alt-lyt .social-links img')
    Array.from(iconsList).forEach(iconElement => {
        const originalSrc = iconElement.getAttribute('src')
        const newSrc = originalSrc.replace('.', '-white.')
        iconElement.setAttribute('src', newSrc)
    })
}

function addInitialIcons() {
    const iconsList = document.querySelectorAll('.nav-footer .social-links img, .contact-info.alt-lyt .social-links img')
    Array.from(iconsList).forEach(iconElement => {
        const originalSrc = iconElement.getAttribute('src')
        const newSrc = originalSrc.replace('-white.', '.')
        iconElement.setAttribute('src', newSrc)
    })
}

// Throttling scroll event

class ScrollingRegister {
    constructor() {
        this.lastScrollY = 0
        this.scrollDirection = null
    }

    setScrollY(scrollYPos) {
        this.lastScrollY = scrollYPos
    }

    getScrollY() {
        return lastScrollY
    }

    defineScrollDirection(scrollYPos) {
        if (scrollYPos > this.lastScrollY) {
            this.setDirection("down")
        }

        if (scrollYPos < this.lastScrollY) {
            this.setDirection("up")
        }

        this.setScrollY(scrollYPos)
    }

    setDirection(scrollDirection) {
        if (this.scrollDirection !== scrollDirection) {
            this.scrollDirection = scrollDirection

            if (this.scrollDirection === "up") {
                showNavbar()
            }

            if (this.scrollDirection === "down") {
                hideNavbar()
            }
        }
    }
}

const scrollingRegister = new ScrollingRegister()

let ticking = false

document.addEventListener("scroll", () => {
    if (window.innerWidth < 1024) {
        if (!ticking) {
            window.requestAnimationFrame(() => {
                scrollingRegister.defineScrollDirection(window.scrollY)
                ticking = false
            })
        }

        ticking = true
    }
})

const navBar = document.querySelector('.nav-bar')

function showNavbar() {
    navBar.style.visibility = "visible"
}

function hideNavbar() {
    const { display } = sideNavbar.style

    if (!display || display === "none") {
        navBar.style.visibility = "hidden"
    }
}

// Intercept anchor links

const portfolioAnchorLink = document.querySelector(".nav-content a[href='index.html#portfolio']")
if (portfolioAnchorLink) portfolioAnchorLink.addEventListener("click", navInnerLink)

function navInnerLink(e) {
    e.preventDefault()
    window.location.href = e.target.getAttribute("href")

    if (window.innerWidth < 560) {
        toggleSideNavbar()
    } else {
        window.scroll(0, window.scrollY - NAV_BAR_HEIGHT)
    }
}

// Restore missing fields when getting a value
const missingGroups = Array.from(document.querySelectorAll('.input-group.missing'))
missingGroups.forEach(msGroup => {
    msGroup.addEventListener("input", restoreInputGroup)
})

function restoreInputGroup(e) {
    const { parentNode } = e.target
    parentNode.className = parentNode.className.replace('missing', '').trim()
    parentNode.removeChild(parentNode.querySelector('.error-msg'))
    parentNode.removeEventListener("input", restoreInputGroup)
}


// Setup page view when HTML content has loaded

document.addEventListener('DOMContentLoaded', setupView)

function setupView() {
    displayJobRoles()
    addWorkTogglers()
    addProjectModals()
    cropAllBlogSums()
    // moveLangSectionUp()
}

// Display job roles for each description

function displayJobRoles() {
    // const firstJobRoles = document.querySelectorAll(".work-desc ul li:nth-child(1) details")
    // Array.from(firstJobRoles).forEach(jobRole => jobRole.setAttribute("open", ""))

    // let firstProjDesc = []
    // if (window.innerWidth > 767) {
    //     firstProjDesc = Array.from(document.querySelectorAll(".proj-desc details")).slice(0, 2)
    //     console.log(firstProjDesc)
    // } else {
    //     firstProjDesc = [ document.querySelector(".proj-desc details") ]
    // }

    // if (!firstProjDesc.length || !firstProjDesc[0]) {
    //     return false
    // }
    // firstProjDesc.forEach(projDesc => {
    //     if (projDesc) projDesc.setAttribute("open", "")
    // })
    let jobRoles = []
    if (window.innerWidth > 767) {
        jobRoles = Array.from(document.querySelectorAll(".work-desc ul li details"))
    } else {
        jobRoles = Array.from(document.querySelectorAll(".work-desc ul li:nth-child(1) details"))
    }

    if (jobRoles.length && jobRoles[0]) {
        jobRoles.forEach(jobRole => {
            jobRole.setAttribute("open", "")
            jobRole.parentElement.style.listStyle = "disclosure-open"
        })
    }
}

function addWorkTogglers() {
    const summaryList = Array.from(document.querySelectorAll(".work-desc li summary"))
    if (summaryList && summaryList.length) {
        summaryList.forEach(summary => summary.addEventListener("click", toggleDisclosures))
    }
}

function toggleDisclosures(e) {
    const listNode = e.target.parentNode.parentNode
    const wasDetailsOpen = e.target.parentNode.hasAttribute("open")
    if (wasDetailsOpen) {
        // Now is closed
        listNode.removeAttribute("style")
    } else {
        // Now is open
        listNode.style.listStyle = "disclosure-open"
    }
}

function addProjectModals() {
    const summaryList = Array.from(document.querySelectorAll(".proj-desc summary"))
    if (summaryList && summaryList.length) {
        summaryList.forEach(summary => summary.addEventListener("click", displayProjModal))
    }
}

function displayProjModal(e) {
    const { display } = sideNavbar.style
    if (window.innerWidth > 767 && (!display || display === "none")) {
        const wasDetailsOpen = e.target.parentNode.hasAttribute("open")
        if (!wasDetailsOpen) {
            isModalOn = true
            deactivateScrolling()
            if (window.innerWidth < 1024) {
                hideNavbar()
            }
            blackout.classList.replace("off", "on")
            blackout.classList.add("modal")

            activeModal = e.target.nextElementSibling
            activeModal.classList.add("on")
        }
    }
}

// While creating the project section
// function moveLangSectionUp() {
//     if (window.innerWidth > 1279) {
//         const skillSection = document.querySelector("section.skills")
//         const langSection = document.querySelector("section.languages")

//         if (skillSection && langSection) {
//             const skillUl = skillSection.querySelector("ul")
//             const topValue = skillSection.clientHeight - skillUl.clientHeight - 64
//             langSection.setAttribute("style", `top: -${topValue}px;`)
//         }
//     }
// }

// Crop blog summary text

function cropAllBlogSums() {
    const paraHeight = 100;
    const blogSumNodes = Array.from(document.querySelectorAll('.blog-desc .blog-sum'))

    if (blogSumNodes.length && blogSumNodes[0]) {
        blogSumNodes.forEach(sumNode => {
            cropText(paraHeight, sumNode)
        })
    }
}

function cropText(maxH, node) {
    while (node.offsetHeight > maxH) {
        const textList = node.textContent.split(' ').slice(0, -1)
        node.textContent = textList.join(' ')
    }
}
