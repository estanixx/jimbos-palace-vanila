 </main>
    <footer class="bg-gray-800 text-center p-4 mt-8">
        <div class="integrantes">
            <h2 class="text-lg font-bold">Integrantes</h2>
            <ul class="text-gray-400">
                <li>Juan Esteban Arango Zapata</li>
                <li>Juan José Arango Marín</li>
                <li>Sacol</li>
            </ul>
        </div>
        <div class="informacion mt-4 text-sm text-gray-500">
            <p><b>Materia:</b> Bases de Datos I</p>
            <p><b>Profesor:</b> Francisco Javier Moreno Arboleda</p>
            <p><b>Institución:</b> Universidad Nacional de Colombia sede Medellín</p>
        </div>
        <div class='toast fixed bottom-5 right-5 opacity-0 flex flex-row justify-center items-center select-none gap-3'>
            <span class='toast-text text-black py-2 px-4 font-medium pixel-font bg-white rounded-lg px-2 py-1'></span>
            <img src='/public/jimbo.png' class="w-20"/>
        </div>
        <audio class='audio-toast'>
            <source src="/public/balatalk.mp3" type='audio/mpeg'>
        </audio>
    </footer>
    
    <script>
        const clickEvent = new MouseEvent('click', {
            bubbles: true,    // The event travels up the DOM tree
            view: window      // The event's view is the window
        });
        audio = document.querySelector('.audio-toast')
        audio.addEventListener('click', () => audio.play())

        gsap.registerPlugin(SplitText);
        let split, animation;
        function showSuccessMessage(message) {
            // Create a styled div for the message
            const globalToast = document.querySelector('.toast');
            const text =  document.querySelector('.toast-text');
            const audio =  document.querySelector('.audio-toast');
            text.innerText = message;
            // Add it to the body
            audio.dispatchEvent(clickEvent);
            split = SplitText.create(text , {type:"chars"});
            gsap.to(globalToast, { opacity: 1, duration: 0.5 })
            gsap.from(split.chars, {
                x: 150,
                opacity: 0,
                delay: 0.5,
                duration: 0.7, 
                ease: "power4",
                stagger: 0.04
            })
            // Remove it after 3 seconds

            gsap.to(globalToast, { opacity: 0, duration: 0.5, delay: 3, onComplete() { document.querySelector('audio').pause() }})

        }

        // Check URL for success message parameter and display it
        document.addEventListener('DOMContentLoaded', () => {
            const urlParams = new URLSearchParams(window.location.search);
            const successMessage = urlParams.get('success');
            if (successMessage) {
                showSuccessMessage(decodeURIComponent(successMessage));
                // Optional: remove the parameter from the URL without reloading
                const newUrl = window.location.pathname;
                window.history.replaceState({}, document.title, newUrl);
            }
        });
    </script>
</body>
</html>