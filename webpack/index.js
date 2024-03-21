import { initSidebar } from './js/modules/sidebar.js';
import { initModals } from './js/modules/modals.js';
import { initFlashcards } from "./js/modules/flashcards.js";
import { initDecks } from "./js/modules/decks.js";
import { initSearch } from "./js/modules/search.js";
import { initAi } from "./js/modules/ai.js";
import { initUsers } from "./js/modules/users.js";
import { initKeywords } from "./js/modules/keywords.js";
import { initEventHandlers } from "./js/modules/eventHandler.js";
import { initSessions } from "./js/modules/learn.js";
import './css/index.css';

$(document).ready(function () {
    initSidebar();
    initModals();
    initDecks();
    initAi();
    initFlashcards();
    initUsers();
    initKeywords();
    initEventHandlers();
    initSessions();
});
