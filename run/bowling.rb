# Spins up basic php servers

puts
puts "Please browse to http://localhost:8080"

dir = File.dirname(__dir__)

Process.spawn('php -S localhost:8000 -t ' + dir + '/src/backend-php/public')
Process.spawn('php -S localhost:8080 -t ' + dir + '/src/frontend-js/public')
