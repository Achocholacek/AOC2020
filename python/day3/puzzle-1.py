
def checkCollision(x, line):
  point = line[x-1]
  if point == "#":
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
slopeX = 3
slopeY = 1
curX = 1
curY = 1
txt = "There are {} collisions on this route."
collisions = 0
while idxRoot < len(input):
  line = input[idxRoot]
  if (curY > 0):
    collisions += checkCollision(curX, line)
  curY += slopeY
  curX += slopeX
  idxRoot += 1
print(txt.format(collisions))