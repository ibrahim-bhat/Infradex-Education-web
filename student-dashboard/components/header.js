class Header extends HTMLElement {
    constructor() {
        super();
        this.innerHTML = `
            <nav class="top-nav">
               
                <div class="mobile-nav">
                    <button class="hamburger-btn d-lg-none">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </nav>
        `;

        // Add event listener for mobile menu
        const hamburgerBtn = this.querySelector('.hamburger-btn');
        if (hamburgerBtn) {
            hamburgerBtn.addEventListener('click', () => {
                document.body.classList.toggle('sidebar-open');
            });
        }
    }
}

customElements.define('dashboard-header', Header); 



/* 
 <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search...">
                </div>
                <div class="nav-actions">
                    <button class="notification-btn">
                        <i class="fas fa-bell"></i>
                        <span class="badge">3</span>
                    </button>
                    <button class="settings-btn">
                        <i class="fas fa-cog"></i>
                    </button>
                </div>
                */