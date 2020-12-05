

def parseString(line):
  line = line.split(": ")
  password = line[1]
  minReq = line[0].split(" ")
  reqChar = minReq[1]
  minReq = minReq[0].split("-")
  idxTwo = int(minReq[1])-1
  idxOne = int(minReq[0])-1
  posOne = password[idxOne]
  posTwo = password[idxTwo]
  matches = 0
  if posOne == reqChar:
      matches += 1
  if posTwo == reqChar:
      matches += 1
  if matches == 1:
    return 1
  else:
    return 0

import numpy as np
inputFile = open("input.txt")
input = np.array([])
for line in inputFile:
  input = np.append(input,line)
inputFile.close()
idxRoot = 0
txt = "There are {} valid passwords in the file."
testInput = np.array(['1-3 a: abcde', '1-3 b: cdefg', '2-9 c: ccccccccc'])
#input = testInput
validPasswords = 0
while idxRoot < len(input):
  passLine = input[idxRoot]
  validPasswords += parseString(passLine)
  idxRoot += 1
print(txt.format(validPasswords))