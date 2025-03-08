@extends('layout.app')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                {{-- <button id="startButton">Start Speech Recognition</button> --}}


                <button id="startVoice">🎤 Start Voice Command</button>
                <p>Recognized Number: <span id="recognizedText">Waiting...</span></p>

            </div>
        </div>
    </div>


    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                if (!("webkitSpeechRecognition" in window) || !("speechSynthesis" in window)) {
                    alert("Speech recognition or synthesis is not supported in this browser.");
                    return;
                }

                const recognition = new webkitSpeechRecognition();
                recognition.continuous = false;
                recognition.lang = "en-US";
                recognition.interimResults = false;

                function speakText(text, callback) {
                    const speech = new SpeechSynthesisUtterance(text);
                    speech.lang = "en-US";
                    speech.rate = 1; // Normal speed
                    speech.onend = callback; // Start recognition after speech
                    window.speechSynthesis.speak(speech);
                }

                function speakText1(text, callback) {
                    const speech = new SpeechSynthesisUtterance(text);
                    speech.lang = "en-US";
                    speech.rate = 1; // Normal speed
                    speech.onend = callback; // Start recognition after speech
                    window.speechSynthesis.speak(speech);
                }

                recognition.onstart = function() {
                    console.log("Voice recognition started...");
                    document.getElementById("recognizedText").textContent = "Listening...";
                };

                recognition.onerror = function(event) {
                    console.error("Speech Recognition Error:", event.error);
                    alert("Error: " + event.error);
                };

                recognition.onend = function() {
                    console.log("Voice recognition ended.");

                    speakText("sorry not found Please try again Enter your shipment tracking number", function() {
                        console.log('sorry not found');
                        recognition.start();

                    });
                };

                recognition.onresult = function(event) {
                    console.log("Raw Event Data:", event);
                    if (!event.results || event.results.length === 0) {
                        alert("No speech detected. Try again.");
                        return;
                    }

                    let spokenText = event.results[0][0].transcript.toLowerCase();
                    console.log("Recognized Text:", spokenText);

                    // Extract only numbers using regex
                    let numbers = spokenText.match(/\d+/g);

                    if (numbers) {
                        let recognizedNumber = numbers.join(""); // Convert array to string
                        console.log("Extracted Number:", recognizedNumber);
                        document.getElementById("recognizedText").textContent = recognizedNumber;
                    } else {
                        console.warn("No numbers detected.");
                        alert("No numbers found. Please try again.");
                    }
                };

                document.getElementById("startVoice").addEventListener("click", function() {
                    console.log("Starting voice recognition...");
                    speakText("Please Enter your shipment tracking number", function() {
                        recognition.start();
                    });
                });
            });
        </script>












        {{-- only number --}}
        {{-- <script>
            document.addEventListener("DOMContentLoaded", function() {
                if (!("webkitSpeechRecognition" in window)) {
                    alert("Speech recognition is not supported in this browser.");
                    return;
                }

                const recognition = new webkitSpeechRecognition();
                recognition.continuous = false;
                recognition.lang = "en-US";
                recognition.interimResults = false; // Get only final results

                recognition.onstart = function() {
                    console.log("Voice recognition started...");
                    document.getElementById("recognizedText").textContent = "Listening...";
                };

                recognition.onerror = function(event) {
                    console.error("Speech Recognition Error:", event.error);
                    alert("Error: " + event.error);
                };

                recognition.onend = function() {
                    console.log("Voice recognition ended.");
                };

                recognition.onresult = function(event) {
                    console.log("Raw Event Data:", event); // Log full event details
                    if (!event.results || event.results.length === 0) {
                        alert("No speech detected. Try again.");
                        return;
                    }

                    let spokenText = event.results[0][0].transcript.toLowerCase();
                    console.log("Recognized Text:", spokenText);

                    // Extract only numbers using regex
                    let numbers = spokenText.match(/\d+/g);

                    if (numbers) {
                        let recognizedNumber = numbers.join(""); // Convert array to string
                        console.log("Extracted Number:", recognizedNumber);
                        document.getElementById("recognizedText").textContent = recognizedNumber;

                        setTimeout(() => {
                            window.location.href = '{{ url('order/order') }}/' + recognizedNumber;
                        }, 5000);
                        // 1000000112
                    } else {
                        console.warn("No numbers detected.");
                        alert("No numbers found. Please try again.");
                    }
                };

                document.getElementById("startVoice").addEventListener("click", function() {
                    console.log("Starting voice recognition...");
                    recognition.start();
                });
            });
        </script> --}}



        {{-- all voice --}}
        {{-- <script>
            document.addEventListener("DOMContentLoaded", function() {
                if (!("webkitSpeechRecognition" in window)) {
                    alert("Speech recognition is not supported in this browser.");
                    return;
                }

                const recognition = new webkitSpeechRecognition();
                recognition.continuous = false;
                recognition.lang = "en-US";
                recognition.interimResults = false; // Get only final results

                recognition.onstart = function() {
                    console.log("Voice recognition started...");
                    document.getElementById("recognizedText").textContent = "Listening...";
                };

                recognition.onerror = function(event) {
                    console.error("Speech Recognition Error:", event.error);
                    alert("Error: " + event.error);
                };

                recognition.onend = function() {
                    console.log("Voice recognition ended.");
                };

                recognition.onresult = function(event) {
                    console.log("Raw Event Data:", event); // Log full event details
                    if (!event.results || event.results.length === 0) {
                        alert("No speech detected. Try again.");
                        return;
                    }

                    let command = event.results[0][0].transcript.toLowerCase();
                    console.log("Recognized Command:", command);

                    // Display the recognized command
                    document.getElementById("recognizedText").textContent = command;

                    // Define voice commands and their corresponding URLs
                    const routes = {
                        "home": "tracking number",
                        "dashboard": "tracking",
                        "profile": "profile.html",
                        "settings": "settings.html",
                        "google": "https://www.google.com",
                    };

                    if (routes[command]) {
                        console.log("Redirecting to:", routes[command]);
                        setTimeout(() => {
                            window.location.href = routes[command];
                        }, 2000);
                    } else {
                        console.warn("Unrecognized command:", command);
                        // alert("Command not recognized: " + command);
                        setTimeout(() => {
                            window.location.href = routes[command];
                        }, 2000);
                    }
                };

                document.getElementById("startVoice").addEventListener("click", function() {
                    console.log("Starting voice recognition...");
                    recognition.start();
                });
            });
        </script> --}}
    @endpush
@endsection
