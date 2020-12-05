import numpy as np
inputFile = open("input.txt")
input = np.array([])
for line in inputFile:
  input = np.append(input,int(line))
inputFile.close()
idxRoot = 0
txt = "{} and {} equal 2020 so the answer is {}"
#testInput = np.array([979, 366, 299, 675, 1721, 1456])
#input = testInput
while idxRoot < len(input):
  root = int(input[idxRoot])
  foll = int(idxRoot) + 1
  while foll < len(input):
    check = int(input[foll])
    if (root + check) == 2020:
      
      answer = root * check
      print(txt.format(root, check, answer))
    foll += 1 
  idxRoot += 1