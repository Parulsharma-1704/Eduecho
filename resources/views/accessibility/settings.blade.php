<x-app-layout>
    <x-slot name="header">
        Accessibility Settings for {{ $student->user->name }}
    </x-slot>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Settings Panel -->
        <div class="lg:col-span-2">
            <!-- Success Message -->
            @if(session('success'))
                <div class="mb-6 bg-emerald-50 dark:bg-emerald-900/30 border border-emerald-200 dark:border-emerald-800 rounded-xl p-4">
                    <p class="text-emerald-800 dark:text-emerald-300 text-sm font-medium">✓ {{ session('success') }}</p>
                </div>
            @endif

            <form action="{{ route('accessibility.update', $student) }}" method="POST" class="space-y-8">
                @csrf
                @method('PATCH')

                <!-- Display Settings Section -->
                <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg p-8 border border-slate-100 dark:border-slate-700">
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-6 flex items-center">
                        <span class="w-8 h-8 rounded-lg bg-gradient-to-br from-blue-500 to-indigo-500 text-white flex items-center justify-center mr-3 text-sm">👁️</span>
                        Display Settings
                    </h3>

                    <div class="space-y-6">
                        <!-- Font Size -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-3">Font Size</label>
                            <div class="flex items-center space-x-4">
                                <input type="range" name="font_size" min="12" max="24" step="2" value="{{ $profile->font_size }}" class="flex-1 h-2 bg-slate-200 dark:bg-slate-700 rounded-lg appearance-none cursor-pointer" id="fontSizeSlider">
                                <span class="text-sm font-semibold text-slate-600 dark:text-slate-400 w-12 text-right" id="fontSizeValue">{{ $profile->font_size }}px</span>
                            </div>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-2">Small (12) to Large (24)</p>
                        </div>

                        <!-- Font Family -->
                        <div>
                            <label for="font_family" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-3">Font Family</label>
                            <select name="font_family" id="font_family" class="w-full px-4 py-2 border border-slate-300 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                                <option value="Roboto" {{ $profile->font_family === 'Roboto' ? 'selected' : '' }}>Roboto (Default)</option>
                                <option value="Serif" {{ $profile->font_family === 'Serif' ? 'selected' : '' }}>Serif</option>
                                <option value="Monospace" {{ $profile->font_family === 'Monospace' ? 'selected' : '' }}>Monospace</option>
                                <option value="Dyslexia" {{ $profile->font_family === 'Dyslexia' ? 'selected' : '' }}>Dyslexia-Friendly</option>
                            </select>
                        </div>

                        <!-- Line Spacing -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-3">Line Spacing</label>
                            <div class="flex items-center space-x-4">
                                <input type="range" name="line_spacing" min="1" max="3" step="0.25" value="{{ $profile->line_spacing }}" class="flex-1 h-2 bg-slate-200 dark:bg-slate-700 rounded-lg appearance-none cursor-pointer" id="lineSpacingSlider">
                                <span class="text-sm font-semibold text-slate-600 dark:text-slate-400 w-12 text-right" id="lineSpacingValue">{{ $profile->line_spacing }}</span>
                            </div>
                        </div>

                        <!-- Letter Spacing -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-3">Letter Spacing</label>
                            <div class="flex items-center space-x-4">
                                <input type="range" name="letter_spacing" min="-10" max="10" step="1" value="{{ $profile->letter_spacing }}" class="flex-1 h-2 bg-slate-200 dark:bg-slate-700 rounded-lg appearance-none cursor-pointer" id="letterSpacingSlider">
                                <span class="text-sm font-semibold text-slate-600 dark:text-slate-400 w-12 text-right" id="letterSpacingValue">{{ $profile->letter_spacing }}</span>
                            </div>
                        </div>

                        <!-- Color Scheme -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-3">Color Scheme</label>
                            <div class="flex gap-4">
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" name="color_scheme" value="light" {{ $profile->color_scheme === 'light' ? 'checked' : '' }} class="w-4 h-4">
                                    <span class="ml-2 text-sm text-slate-600 dark:text-slate-400">Light</span>
                                </label>
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" name="color_scheme" value="dark" {{ $profile->color_scheme === 'dark' ? 'checked' : '' }} class="w-4 h-4">
                                    <span class="ml-2 text-sm text-slate-600 dark:text-slate-400">Dark</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Visual Enhancements -->
                <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg p-8 border border-slate-100 dark:border-slate-700">
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-6 flex items-center">
                        <span class="w-8 h-8 rounded-lg bg-gradient-to-br from-purple-500 to-pink-500 text-white flex items-center justify-center mr-3 text-sm">🎨</span>
                        Visual Enhancements
                    </h3>

                    <div class="space-y-4">
                        <label class="flex items-center p-4 border border-slate-200 dark:border-slate-700 rounded-lg cursor-pointer hover:bg-slate-50 dark:hover:bg-slate-700/50 transition">
                            <input type="checkbox" name="high_contrast" value="1" {{ $profile->high_contrast ? 'checked' : '' }} class="w-5 h-5 rounded text-blue-600">
                            <div class="ml-3">
                                <p class="font-semibold text-slate-900 dark:text-white">High Contrast</p>
                                <p class="text-sm text-slate-600 dark:text-slate-400">Increases contrast for better visibility</p>
                            </div>
                        </label>

                        <label class="flex items-center p-4 border border-slate-200 dark:border-slate-700 rounded-lg cursor-pointer hover:bg-slate-50 dark:hover:bg-slate-700/50 transition">
                            <input type="checkbox" name="invert_colors" value="1" {{ $profile->invert_colors ? 'checked' : '' }} class="w-5 h-5 rounded text-blue-600">
                            <div class="ml-3">
                                <p class="font-semibold text-slate-900 dark:text-white">Invert Colors</p>
                                <p class="text-sm text-slate-600 dark:text-slate-400">Inverts all colors for reading comfort</p>
                            </div>
                        </label>

                        <label class="flex items-center p-4 border border-slate-200 dark:border-slate-700 rounded-lg cursor-pointer hover:bg-slate-50 dark:hover:bg-slate-700/50 transition">
                            <input type="checkbox" name="reading_guide" value="1" {{ $profile->reading_guide ? 'checked' : '' }} class="w-5 h-5 rounded text-blue-600">
                            <div class="ml-3">
                                <p class="font-semibold text-slate-900 dark:text-white">Reading Guide</p>
                                <p class="text-sm text-slate-600 dark:text-slate-400">Shows a reading line to help track text</p>
                            </div>
                        </label>

                        <label class="flex items-center p-4 border border-slate-200 dark:border-slate-700 rounded-lg cursor-pointer hover:bg-slate-50 dark:hover:bg-slate-700/50 transition">
                            <input type="checkbox" name="focus_mode" value="1" {{ $profile->focus_mode ? 'checked' : '' }} class="w-5 h-5 rounded text-blue-600">
                            <div class="ml-3">
                                <p class="font-semibold text-slate-900 dark:text-white">Focus Mode</p>
                                <p class="text-sm text-slate-600 dark:text-slate-400">Hides distractions and highlights current content</p>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Assistive Technologies -->
                <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg p-8 border border-slate-100 dark:border-slate-700">
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-6 flex items-center">
                        <span class="w-8 h-8 rounded-lg bg-gradient-to-br from-emerald-500 to-teal-500 text-white flex items-center justify-center mr-3 text-sm">🔊</span>
                        Assistive Technologies
                    </h3>

                    <div class="space-y-4">
                        <label class="flex items-center p-4 border border-slate-200 dark:border-slate-700 rounded-lg cursor-pointer hover:bg-slate-50 dark:hover:bg-slate-700/50 transition">
                            <input type="checkbox" name="text_to_speech" value="1" {{ $profile->text_to_speech ? 'checked' : '' }} class="w-5 h-5 rounded text-blue-600">
                            <div class="ml-3">
                                <p class="font-semibold text-slate-900 dark:text-white">Text-to-Speech</p>
                                <p class="text-sm text-slate-600 dark:text-slate-400">Reads text content aloud</p>
                            </div>
                        </label>

                        <label class="flex items-center p-4 border border-slate-200 dark:border-slate-700 rounded-lg cursor-pointer hover:bg-slate-50 dark:hover:bg-slate-700/50 transition">
                            <input type="checkbox" name="screen_reader_mode" value="1" {{ $profile->screen_reader_mode ? 'checked' : '' }} class="w-5 h-5 rounded text-blue-600">
                            <div class="ml-3">
                                <p class="font-semibold text-slate-900 dark:text-white">Screen Reader Mode</p>
                                <p class="text-sm text-slate-600 dark:text-slate-400">Optimized for screen readers</p>
                            </div>
                        </label>

                        <label class="flex items-center p-4 border border-slate-200 dark:border-slate-700 rounded-lg cursor-pointer hover:bg-slate-50 dark:hover:bg-slate-700/50 transition">
                            <input type="checkbox" name="voice_control" value="1" {{ $profile->voice_control ? 'checked' : '' }} class="w-5 h-5 rounded text-blue-600">
                            <div class="ml-3">
                                <p class="font-semibold text-slate-900 dark:text-white">Voice Control</p>
                                <p class="text-sm text-slate-600 dark:text-slate-400">Enables voice command navigation</p>
                            </div>
                        </label>

                        <label class="flex items-center p-4 border border-slate-200 dark:border-slate-700 rounded-lg cursor-pointer hover:bg-slate-50 dark:hover:bg-slate-700/50 transition">
                            <input type="checkbox" name="keyboard_only" value="1" {{ $profile->keyboard_only ? 'checked' : '' }} class="w-5 h-5 rounded text-blue-600">
                            <div class="ml-3">
                                <p class="font-semibold text-slate-900 dark:text-white">Keyboard Only</p>
                                <p class="text-sm text-slate-600 dark:text-slate-400">Navigate using keyboard only (no mouse)</p>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-4">
                    <button type="submit" class="flex-1 px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl hover:shadow-lg hover:shadow-blue-500/30 transition-all hover:scale-[1.02] active:scale-[0.98] font-semibold">
                        Save Settings
                    </button>
                    <form action="{{ route('accessibility.reset', $student) }}" method="POST" class="flex-1">
                        @csrf
                        <button type="submit" onclick="return confirm('Reset all settings to defaults?')" class="w-full px-6 py-3 bg-slate-200 dark:bg-slate-700 text-slate-900 dark:text-white rounded-xl hover:bg-slate-300 dark:hover:bg-slate-600 transition font-semibold">
                            Reset to Defaults
                        </button>
                    </form>
                </div>
            </form>
        </div>

        <!-- Preview Panel -->
        <div class="lg:col-span-1">
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg p-8 border border-slate-100 dark:border-slate-700 sticky top-20">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-6">📋 Preview</h3>
                
                <div id="previewArea" class="space-y-6 p-4 rounded-lg bg-slate-50 dark:bg-slate-900" style="font-size: {{ $profile->font_size }}px; line-height: {{ $profile->line_spacing }}; letter-spacing: {{ $profile->letter_spacing * 0.1 }}em;">
                    <p class="text-sm font-semibold text-slate-600 dark:text-slate-400">Sample Text Preview</p>
                    <p>The quick brown fox jumps over the lazy dog. This is a sample text to preview your accessibility settings.</p>
                    <p class="text-sm">You can see how different font sizes, spacing, and colors affect readability.</p>
                </div>

                <div class="mt-6 space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-slate-600 dark:text-slate-400">Font Size:</span>
                        <span class="font-semibold text-slate-900 dark:text-white" id="previewFontSize">{{ $profile->font_size }}px</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-600 dark:text-slate-400">Line Height:</span>
                        <span class="font-semibold text-slate-900 dark:text-white" id="previewLineHeight">{{ $profile->line_spacing }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-600 dark:text-slate-400">Font:</span>
                        <span class="font-semibold text-slate-900 dark:text-white" id="previewFont">{{ $profile->font_family }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const fontSizeSlider = document.getElementById('fontSizeSlider');
        const lineSpacingSlider = document.getElementById('lineSpacingSlider');
        const letterSpacingSlider = document.getElementById('letterSpacingSlider');
        const previewArea = document.getElementById('previewArea');

        function updatePreview() {
            const fontSize = fontSizeSlider.value;
            const lineSpacing = lineSpacingSlider.value;
            const letterSpacing = letterSpacingSlider.value;

            document.getElementById('fontSizeValue').textContent = fontSize + 'px';
            document.getElementById('lineSpacingValue').textContent = lineSpacing;
            document.getElementById('letterSpacingValue').textContent = letterSpacing;

            previewArea.style.fontSize = fontSize + 'px';
            previewArea.style.lineHeight = lineSpacing;
            previewArea.style.letterSpacing = (letterSpacing * 0.1) + 'em';

            document.getElementById('previewFontSize').textContent = fontSize + 'px';
            document.getElementById('previewLineHeight').textContent = lineSpacing;
        }

        fontSizeSlider.addEventListener('input', updatePreview);
        lineSpacingSlider.addEventListener('input', updatePreview);
        letterSpacingSlider.addEventListener('input', updatePreview);
    </script>
</x-app-layout>
