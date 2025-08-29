from flask import Flask, render_template

app = Flask(__name__)

@app.route('/')
def index():
    return render_template('index.html')

@app.route('/booking')
def booking():
    return render_template('booking.html')

@app.route('/customers')
def customers():
    return render_template('customers.html')

@app.route('/rooms')
def rooms():
    return render_template('rooms.html')

if __name__ == '__main__':
    app.run(debug=True)
