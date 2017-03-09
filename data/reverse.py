import csv
with open('fbndx.csv', 'r') as textfile:
    for row in reversed(list(csv.reader(textfile))):
        print ','.join(row)