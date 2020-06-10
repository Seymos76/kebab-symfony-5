module.exports = {
    theme: {
        //screens: {
        //    xs: { 'min': '320px', 'max': '639px' },
        //    sm: { 'min': '640px', 'max': '767px' },
        //    md: { 'min': '768px', 'max': '1023px' },
        //    lg: { 'min': '1024px', 'max': '1279px' },
        //    xl: { 'min': '1280px', 'max': '1920px' },
        //},
        screens: {
            'xs': '320px',
            'sm': '640px',
            'md': '768px',
            'lg': '1024px',
            'xl': '1280px'
        },
        fontFamily: {
            display: ['Gilroy', 'sans-serif'],
            body: ['Graphik', 'sans-serif'],
        },
        borderWidth: {
            default: '1px',
            '0': '0',
            '2': '2px',
            '4': '4px',
        },
        borderColor: {
            primary: '#e2faff',
        },
        extend: {
            colors: {
                cyan: '#9cdbff',
            },
            spacing: {
                '96': '24rem',
                '128': '32rem',
            }
        }
    }
}