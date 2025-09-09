{{-- Content Protection Component --}}
<style>
    /* Anti-Copy Protection Styles */
    .protected-content {
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        -webkit-touch-callout: none;
        -webkit-tap-highlight-color: transparent;
        -webkit-user-drag: none;
        -khtml-user-drag: none;
        -moz-user-drag: none;
        -o-user-drag: none;
        user-drag: none;
    }
    
    .protected-content::selection {
        background: transparent;
    }
    
    .protected-content::-moz-selection {
        background: transparent;
    }
    
    .protected-content * {
        -webkit-user-select: none !important;
        -moz-user-select: none !important;
        -ms-user-select: none !important;
        user-select: none !important;
    }
    
    .protected-content img {
        -webkit-user-drag: none;
        -khtml-user-drag: none;
        -moz-user-drag: none;
        -o-user-drag: none;
        user-drag: none;
        pointer-events: none;
    }
    
    /* Print Protection */
    @media print {
        .protected-content {
            display: none !important;
        }
        .print-protection-message {
            display: block !important;
            visibility: visible !important;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            font-size: 18px;
            color: black;
            background: white;
            padding: 40px;
            border: 2px solid black;
            z-index: 9999;
        }
    }
    
    .print-protection-message {
        display: none;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Proteksi untuk konten yang dilindungi
    const protectedElements = document.querySelectorAll('.protected-content');
    
    protectedElements.forEach(function(element) {
        // Mencegah context menu (klik kanan) - lebih lembut di mobile
        element.addEventListener('contextmenu', function(e) {
            e.preventDefault();
            // Hanya tampilkan pesan jika bukan mobile atau jika benar-benar long press
            if (!isMobileDevice()) {
                showProtectionMessage('Context menu dinonaktifkan untuk melindungi konten');
            }
            return false;
        });
        
        // Mencegah drag
        element.addEventListener('dragstart', function(e) {
            e.preventDefault();
            return false;
        });
        
        // Mencegah seleksi dengan mouse
        element.addEventListener('selectstart', function(e) {
            e.preventDefault();
            return false;
        });
        
        // Mencegah touch events pada mobile (hanya multi-touch untuk zoom)
        element.addEventListener('touchstart', function(e) {
            // Hanya cegah jika ada lebih dari 1 touch point (pinch to zoom)
            if (e.touches.length > 1) {
                e.preventDefault();
                showProtectionMessage('Zoom tidak diizinkan pada konten ini');
                return false;
            }
        });
        
        // Mencegah long press pada mobile
        element.addEventListener('touchend', function(e) {
            // Cegah long press hanya jika durasi touch > 800ms
            clearTimeout(this.touchTimeout);
        });
        
        element.addEventListener('touchstart', function(e) {
            this.touchTimeout = setTimeout(function() {
                // showProtectionMessage('Long press tidak diizinkan');
            }, 800);
        });
    });
    
    // Mencegah keyboard shortcuts (hanya di desktop)
    document.addEventListener('keydown', function(e) {
        // Skip keyboard protection pada mobile
        if (isMobileDevice()) {
            return true;
        }
        
        // Daftar shortcut yang diblokir
        const blockedKeys = [
            { ctrl: true, key: 'a' }, // Select All
            { ctrl: true, key: 'c' }, // Copy
            { ctrl: true, key: 'x' }, // Cut
            { ctrl: true, key: 'v' }, // Paste
            { ctrl: true, key: 's' }, // Save
            { ctrl: true, key: 'p' }, // Print
            { ctrl: true, key: 'u' }, // View Source
            { key: 'F12' }, // Developer Tools
            { ctrl: true, shift: true, key: 'I' }, // Developer Tools
            { ctrl: true, shift: true, key: 'J' }, // Console
            { ctrl: true, shift: true, key: 'C' }, // Inspect Element
        ];
        
        const currentKey = {
            ctrl: e.ctrlKey,
            shift: e.shiftKey,
            key: e.key
        };
        
        const isBlocked = blockedKeys.some(blocked => {
            return (!blocked.ctrl || currentKey.ctrl) &&
                   (!blocked.shift || currentKey.shift) &&
                   blocked.key === currentKey.key;
        });
        
        if (isBlocked) {
            e.preventDefault();
            if (currentKey.key === 'c' || currentKey.key === 'x') {
                showProtectionMessage('Menyalin konten tidak diizinkan');
            } else if (currentKey.key === 's') {
                showProtectionMessage('Menyimpan halaman tidak diizinkan');
            } else if (currentKey.key === 'p') {
                showProtectionMessage('Mencetak konten tidak diizinkan');
            } else if (currentKey.key === 'F12' || (currentKey.ctrl && currentKey.shift)) {
                showProtectionMessage('Developer tools dinonaktifkan');
            }
            return false;
        }
    });
    
    // Mencegah copy dari clipboard API (hanya di desktop)
    document.addEventListener('copy', function(e) {
        // Skip copy protection pada mobile untuk menghindari gangguan
        if (isMobileDevice()) {
            return true;
        }
        
        e.clipboardData.setData('text/plain', '');
        e.preventDefault();
        showProtectionMessage('Menyalin konten tidak diizinkan');
        return false;
    });
    
    // Mencegah print (semua platform)
    window.addEventListener('beforeprint', function(e) {
        e.preventDefault();
        showProtectionMessage('Mencetak konten tidak diizinkan');
        return false;
    });
    
    // Deteksi developer tools (hanya untuk desktop)
    let devtools = false;
    
    // Hanya jalankan deteksi developer tools di desktop
    function isMobileDevice() {
        return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ||
               window.innerWidth <= 768 ||
               ('ontouchstart' in window) ||
               (navigator.maxTouchPoints > 0);
    }
    
    if (!isMobileDevice()) {
        setInterval(function() {
            // Gunakan threshold yang lebih besar untuk menghindari false positive
            if (window.outerHeight - window.innerHeight > 300 || window.outerWidth - window.innerWidth > 300) {
                if (!devtools) {
                    devtools = true;
                    showProtectionMessage('Developer tools terdeteksi. Konten dilindungi hak cipta.');
                    setTimeout(function() {
                        window.location.href = '/';
                    }, 3000);
                }
            } else {
                devtools = false;
            }
        }, 2000); // Interval lebih lambat untuk performa
    }
    
    // Fungsi untuk menampilkan pesan proteksi
    function showProtectionMessage(message) {
        // Hapus notifikasi yang sudah ada
        const existingNotification = document.querySelector('.protection-notification');
        if (existingNotification) {
            existingNotification.remove();
        }
        
        // Buat elemen notifikasi baru
        const notification = document.createElement('div');
        notification.className = 'protection-notification';
        notification.innerHTML = `
            <div style="position: fixed; top: 20px; right: 20px; background: #dc2626; color: white; padding: 16px 20px; border-radius: 8px; box-shadow: 0 10px 25px rgba(0,0,0,0.2); z-index: 99999; font-family: 'Inter', Arial, sans-serif; font-size: 14px; max-width: 320px; animation: slideIn 0.3s ease-out;">
                <div style="display: flex; align-items: flex-start;">
                    <svg style="width: 20px; height: 20px; margin-right: 12px; flex-shrink: 0; margin-top: 1px;" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    <div>
                        <div style="font-weight: 600; margin-bottom: 4px;">Konten Dilindungi</div>
                        <div style="font-size: 13px; opacity: 0.9; line-height: 1.4;">${message}</div>
                    </div>
                </div>
            </div>
        `;
        
        // Tambahkan animasi
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideIn {
                from {
                    transform: translateX(100%);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
            @keyframes slideOut {
                from {
                    transform: translateX(0);
                    opacity: 1;
                }
                to {
                    transform: translateX(100%);
                    opacity: 0;
                }
            }
        `;
        
        if (!document.querySelector('style[data-protection-styles]')) {
            style.setAttribute('data-protection-styles', '');
            document.head.appendChild(style);
        }
        
        document.body.appendChild(notification);
        
        // Hapus notifikasi setelah 4 detik dengan animasi
        setTimeout(function() {
            if (notification.parentNode) {
                notification.firstElementChild.style.animation = 'slideOut 0.3s ease-in forwards';
                setTimeout(function() {
                    if (notification.parentNode) {
                        notification.parentNode.removeChild(notification);
                    }
                }, 300);
            }
        }, 4000);
    }
});
</script>

{{-- Print Protection Message --}}
<div class="print-protection-message">
    <h1>⚠️ KONTEN DILINDUNGI</h1>
    <p>Konten ini tidak dapat dicetak, disalin, atau didistribusikan tanpa izin.</p>
    <p><strong>© BKPSDM Kabupaten Katingan</strong></p>
    <p>Hubungi kami untuk informasi lebih lanjut tentang penggunaan konten.</p>
</div>
