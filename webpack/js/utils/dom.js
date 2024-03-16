// Fonctions de sélection d'éléments

export function getElementById(id)
{
    return document.getElementById(id);
}

export function getElementsByClass(className)
{
    return document.getElementsByClassName(className);
}

export function querySelector(selector)
{
    return document.querySelector(selector);
}

export function querySelectorAll(selector)
{
    return document.querySelectorAll(selector);
}

// Fonctions de manipulation d'éléments

export function addClass(element, className)
{
    element.classList.add(className);
}

export function removeClass(element, className)
{
    element.classList.remove(className);
}

export function setTextContent(element, textContent)
{
    element.textContent = textContent;
}

export function setInnerHTML(element, html)
{
    element.innerHTML = html;
}

// Fonctions de création d'éléments

export function createElement(tagName, attributes = {})
{
    const element = document.createElement(tagName);
    for (const [key, value] of Object.entries(attributes)) {
        element.setAttribute(key, value);
    }
    return element;
}

// Fonctions d'événements

export function addEventListener(element, event, callback)
{
    element.addEventListener(event, callback);
}

export function removeEventListener(element, event, callback)
{
    element.removeEventListener(event, callback);
}

// Fonctions utilitaires

export function getClosest(element, selector)
{
    let parent = element;
    while (parent && !parent.matches(selector)) {
        parent = parent.parentNode;
    }
    return parent;
}

export function getData(element, name)
{
    return element.dataset[name];
}

export function setData(element, name, value)
{
    element.dataset[name] = value;
}