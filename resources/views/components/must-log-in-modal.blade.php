<div class="fixed inset-0 z-50 bg-primary-accent/50 backdrop-blur flex items-center justify-center transition-all" style="display: none" id="must_login_modal">
    <div class="flex items-center justify-center flex-col bg-primary-card p-6 shadow_caja border-2 border-primary-accent-sub rounded space-y-4">
        <p class="gradient_full_di text-2xl">Hello Stranger!</p>
        <p>You must log in to perform this action</p>
        <div class="flex items-center justify-center space-x-4">
            <x-a-button href="''" :icon="'login'">LOGIN</x-a-button>
            <x-di-button type="button" :icon="''" onclick="this.parentNode.parentNode.parentNode.style.display = 'none';">DISMISS</x-di-button>
        </div>
    </div>
</div>
