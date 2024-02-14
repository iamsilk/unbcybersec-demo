from flask import Flask, render_template, request
import os
import sys
import subprocess

app = Flask(__name__)

@app.route("/", methods=["GET", "POST"])
def calculator():
    if request.method == "POST":
        expression = request.form["expression"]
        
        try:
            loc = {}
            exec('result = ' + expression, globals(), loc)
            result = loc.get('result')
        except Exception as e:
            result = f"Error: {str(e)}"
        return render_template("index.html", expression=expression, result=result)
    return render_template("index.html", expression=None, result=None)

if __name__ == "__main__":
    app.run(host='0.0.0.0', debug=True)