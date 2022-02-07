module.exports = {
    content: [
        './public/index.php',
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        fontFamily: {
            'mono': 'Roboto Mono',
            'serif': 'Inter',
            'title': 'Inter',
            'cursive': 'Comfortaa',
            'numeric': 'Inter'
            // 'title': 'Acme'
        },
        maxHeight: {
            '700': '700px'
        },
        extend: {
            animation: {
                'spin-slow': 'spin 3s linear infinite',
            },
            boxShadow:{
                black: 'inset 0 0 6px 6px #f1c42b',
            },
            backgroundImage: {
                'banner': "url('/img/banner.jpg')",
                'bg': "url('/img/bg.png')",
                'pat1': "url('/img/pat1.png')",
                'pat2': "url('/img/pat2.png')",
                'pat3': "url('/img/pat3.png')",
                'waves': "url('/img/waves.jpg')",
                'guide': "url('/img/banner_guide.jpg')",
            },
            colors: {
                'primary': {
                    'background': '#334756',
                    'background-sub': '#454488',
                    'accent': '#9e8cfa',
                    'accent-light': '#F3DE8A',
                    'accent-sub': '#9d60ff',
                    'accent-sub-dark': '#9e8cfa',
                    'card': '#2f3476',
                    'card-sub': '#454488',
                    'text': '#e4e8eb',
                    'text-muted': '#cbd5e1',
                    'text-accent': '#312e81',
                    'icon': '#f1c42b',
                    'standard-border': '#6547ff',
                    'placeholder': '#94a3b8',
                },

                pure: '#eab308',
                strength: '#FCA5A5',
                agility: '#FDE68A',
                intelligence: '#93C5FD',
                on: '#22c55e',
                off: '#ef4444',
                gold: '#DAA520',
                silver: '#D3D3D3',

                prim_a: '#9e8cfa',
                prim_b: '#6547ff',
                prim_c: '#454488',
                prim_d: '#2f3476',
                border_prim: '#9d60ff',


            },


        },

    },

    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
        require('tailwind-scrollbar'),
    ],

}
