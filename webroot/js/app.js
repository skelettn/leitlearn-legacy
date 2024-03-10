import { initSidebar } from './modules/sidebar.js';
import { initModals } from './modules/modals.js';
import { initFlashcards } from "./modules/flashcards.js";
import { initDecks } from "./modules/decks.js";
import { initAi } from "./modules/ai.js";
import { initExplore } from "./modules/explore.js";
import { initUsers } from "./modules/users.js";
import { initKeywords } from "./modules/keywords.js";
import { initEventHandlers } from "./modules/eventHandler.js";

$(document).ready(function () {
    initSidebar();
    initModals();
    initDecks();
    initAi();
    initExplore();
    initFlashcards();
    initUsers();
    initKeywords();
    initEventHandlers();
});
