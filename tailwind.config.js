import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
                display: ['Poppins', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // EduEcosystem Brand Colors
                'edu-yellow': '#FFB800',
                'edu-yellow-light': '#FFF3CC',
                'edu-pink': '#FF4D8F',
                'edu-pink-light': '#FFE6F1',
                'edu-purple': '#7B5EF8',
                'edu-purple-light': '#EEE9FF',
                'edu-teal': '#00BFA6',
                'edu-teal-light': '#E0F9F6',
                'edu-navy': '#1A1F36',
                'edu-soft': '#F8F7FF',
                'edu-white': '#FFFFFF',
                'edu-gray-text': '#6B7280',
                'edu-gray-muted': '#9CA3AF',
                'edu-gray-bg': '#F3F4F6',
            },
            boxShadow: {
                'card': '0 4px 20px rgba(26, 31, 54, 0.06)',
                'hover': '0 12px 40px rgba(26, 31, 54, 0.12)',
                'yellow': '0 8px 28px rgba(255, 184, 0, 0.32)',
                'pink': '0 8px 24px rgba(255, 77, 143, 0.32)',
                'purple': '0 8px 24px rgba(123, 94, 248, 0.24)',
            },
            borderRadius: {
                'sm': '8px',
                'md': '12px',
                'lg': '16px',
                'xl': '20px',
                '2xl': '28px',
                'pill': '100px',
            },
            animation: {
                'float': 'float 3s ease-in-out infinite',
                'pulse-ring': 'pulseRing 2.5s infinite',
                'slide-in-up': 'slideInUp 0.7s ease-out',
                'slide-in-left': 'slideInLeft 0.6s ease-out',
                'wiggle': 'wiggle 0.4s ease-in-out',
                'fade-in': 'fadeIn 0.5s ease-in',
            },
            keyframes: {
                float: {
                    '0%, 100%': { transform: 'translateY(0px)' },
                    '50%': { transform: 'translateY(-10px)' },
                },
                pulseRing: {
                    '0%': { boxShadow: '0 0 0 0 rgba(255, 184, 0, 0.4)' },
                    '70%': { boxShadow: '0 0 0 14px rgba(255, 184, 0, 0)' },
                    '100%': { boxShadow: '0 0 0 0 rgba(255, 184, 0, 0)' },
                },
                slideInUp: {
                    'from': { opacity: '0', transform: 'translateY(24px)' },
                    'to': { opacity: '1', transform: 'translateY(0)' },
                },
                slideInLeft: {
                    'from': { opacity: '0', transform: 'translateX(-24px)' },
                    'to': { opacity: '1', transform: 'translateX(0)' },
                },
                wiggle: {
                    '0%, 100%': { transform: 'rotate(0deg)' },
                    '25%': { transform: 'rotate(-6deg)' },
                    '75%': { transform: 'rotate(6deg)' },
                },
                fadeIn: {
                    'from': { opacity: '0' },
                    'to': { opacity: '1' },
                },
            },
        },
    },

    plugins: [forms],
};
