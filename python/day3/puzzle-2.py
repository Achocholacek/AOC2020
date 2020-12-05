
def checkCollision(x, line):
  point = line[x-1]
  if point == "#":
    return 1
  else:
    return 0

import numpy as np
inputFile = open("input.txt")
input = np.array([])
collisionCollection = np.array([])
for line in inputFile:
  input = np.append(input,line)
inputFile.close()
slopes = np.array([[1,1], [3,1], [5,1], [7,1], [1,2]])

for slopeXY in slopes:
    idxRoot = 0
    slopeX = slopeXY[0]
    slopeY = slopeXY[1]
    curX = 1
    curY = 0
    collisions = 0
    while idxRoot < len(input):
      line = input[idxRoot]
      if (curY > 0 and curY < len(input)):
        collisions += checkCollision(curX, input[curY])
      curY += slopeY
      curX += slopeX
      idxRoot += 1
    collisionCollection = np.append(collisionCollection, collisions)
answer = 1
for x in collisionCollection:
    answer = x * answer
txt = "The Answer is {}"
print(txt.format(answer))